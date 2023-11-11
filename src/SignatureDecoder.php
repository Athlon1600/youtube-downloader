<?php

namespace YouTube;

/*
 *
 * Go into YouTube's player.js, find a code that looks like this:
 *
 * ZKa = function(a) {
    a = a.split("");
    YKa.uB(a, 2);
    YKa.Us(a, 43);
    YKa.fY(a, 50);
    return a.join("")
};

and translate it to PHP
 *
 */

class SignatureDecoder
{
    /**
     * @param string $signature
     * @param string $js_code Complete source code for YouTube's player.js
     * @return string|null
     */
    public function decode(string $signature, string $js_code): ?string
    {
        $func_name = $this->parseFunctionName($js_code);

        if (!$func_name) {
            //Could not parse signature function name
            return null;
        }

        // PHP instructions
        $instructions = (array)$this->parseFunctionCode($func_name, $js_code);

        if (count($instructions) === 0) {
            // Could not parse any signature instructions
            return null;
        }

        foreach ($instructions as $opt) {

            $command = $opt[0];
            $value = $opt[1];

            if ($command == 'swap') {

                $temp = $signature[0];
                $signature[0] = $signature[$value % strlen($signature)];
                $signature[$value] = $temp;

            } elseif ($command == 'splice') {
                $signature = substr($signature, $value);
            } elseif ($command == 'reverse') {
                $signature = strrev($signature);
            }
        }

        return trim($signature);
    }

    protected function parseFunctionName(string $js_code): ?string
    {
        if (preg_match('@,\s*encodeURIComponent\((\w{2})@is', $js_code, $matches)) {
            return preg_quote($matches[1]);
        } else if (preg_match('@(?:\b|[^a-zA-Z0-9$])([a-zA-Z0-9$]{2,3})\s*=\s*function\(\s*a\s*\)\s*{\s*a\s*=\s*a\.split\(\s*""\s*\)@is', $js_code, $matches)) {
            return preg_quote($matches[1]);
        }

        return null;
    }

    // convert JS code for signature decipher to PHP code
    protected function parseFunctionCode(string $func_name, string $player_html): ?array
    {
        // extract code block from that function
        // single quote in case function name contains $dollar sign
        // xm=function(a){a=a.split("");wm.zO(a,47);wm.vY(a,1);wm.z9(a,68);wm.zO(a,21);wm.z9(a,34);wm.zO(a,16);wm.z9(a,41);return a.join("")};
        if (preg_match('/' . $func_name . '=function\([a-z]+\){(.*?)}/', $player_html, $matches)) {

            $js_code = $matches[1];

            // extract all relevant statements within that block
            // wm.vY(a,1);
            if (preg_match_all('/([a-z0-9$]{2})\.([a-z0-9]{2})\([^,]+,(\d+)\)/i', $js_code, $matches) != false) {

                // wm
                $obj_list = $matches[1];

                // vY
                $func_list = $matches[2];

                // extract javascript code for each one of those statement functions
                preg_match_all('/(' . implode('|', $func_list) . '):function(.*?)\}/m', $player_html, $matches2, PREG_SET_ORDER);

                $functions = array();

                // translate each function according to its use
                foreach ($matches2 as $m) {

                    if (strpos($m[2], 'splice') !== false) {
                        $functions[$m[1]] = 'splice';
                    } elseif (strpos($m[2], 'a.length') !== false) {
                        $functions[$m[1]] = 'swap';
                    } elseif (strpos($m[2], 'reverse') !== false) {
                        $functions[$m[1]] = 'reverse';
                    }
                }

                // FINAL STEP! convert it all to instructions set
                $instructions = array();

                foreach ($matches[2] as $index => $name) {
                    $instructions[] = array($functions[$name], $matches[3][$index]);
                }

                return $instructions;
            }
        }

        return null;
    }
}
