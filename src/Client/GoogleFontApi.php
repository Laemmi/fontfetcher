<?php
/**
 * Copyright 2007-2018 Andreas Heigl/wdv Gesellschaft für Medien & Kommunikation mbH & Co. OHG
 *
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category    fontfetcher
 * @author      Michael Lämmlein <m.laemmlein@wdv.de>
 * @copyright   ©2007-2018 Andreas Heigl/wdv Gesellschaft für Medien & Kommunikation mbH & Co. OHG
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     3.1.0
 * @since       24.05.18
 */

namespace Laemmi\FontFetcher\Client;

use Laemmi\FontFetcher\FontFetcherInterface;

class GoogleFontApi extends Copy implements FontFetcherInterface
{
    private $api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=';

    private $api_key = '';

    public function setApiKey(string $value)
    {
        $this->api_key = $value;
    }

    public function fetch(string $source, string $dest) : bool
    {
        $files = $this->getFiles($source);

        $format = $dest . '/' . str_replace(' ', '', $source) . '-%1$s.ttf';
        foreach ($files as $key => $val) {
            parent::fetch($val, sprintf($format, $this->getVariantName($key)));
        }

        return true;
    }

    private function getFiles(string $source) : array
    {
        $url = $this->api_url . $this->api_key;

        $data = json_decode(file_get_contents($url),true);

        foreach ($data['items'] as $item) {
            if ($source !== $item['family']) {
                continue;
            }
            return $item['files'];
        }

        return [];
    }

    private function getVariantName($value)
    {
        switch ($value) {
            case '900':
                return 'Black';
            case '800':
                return 'ExtraBold';
            case '700':
                return 'Bold';
            case '600':
                return 'SemiBold';
            case 'regular':
                return 'Regular';
            case '300':
                return 'Light';
            case '200':
                return 'ExtraLight';
            case '900italic':
                return 'BlackItalic';
            case '800italic':
                return 'ExtraBoldItalic';
            case '700italic':
                return 'BoldItalic';
            case '600italic':
                return 'SemiBoldItalic';
            case 'italic':
                return 'Italic';
            case '300italic':
                return 'LightItalic';
            case '200italic':
                return 'ExtraLightItalic';
            default:
                return 'Regular';
        }
    }
}