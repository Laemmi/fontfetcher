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

namespace LaemmiTest\FontFetcher\Client;

use Laemmi\FontFetcher\Client\GoogleFontApi;
use PHPUnit\Framework\TestCase;

class GoogleFontApiTest extends TestCase
{
    public function testFetch()
    {
        $client = new GoogleFontApi();

        $config = parse_ini_file('./tests/config.ini', true);
        $apikey = $config['GoogleFontApiTest']['apikey'];
        $source = 'Open Sans';
        $dest   = realpath('./tmp');

        $client->setApiKey($apikey);

        $client->fetch($source, $dest);
    }
}