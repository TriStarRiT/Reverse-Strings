<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/index.php';

class PhpTests  extends TestCase
{
    public function testSingleWordEng()
    {
        $input = "houSe";
        $expected = "esuOh";
        $this->assertEquals($expected, execute($input));
    }

    public function testSingleWordRus()
    {
        $input = "Мышь";
        $expected = "Ьшым";
        $this->assertEquals($expected, execute($input));
    }

    public function testSentenceWithPunctuationEng()
    {
        $input = 'is "cold" now';
        $expected = 'si "dloc" won';
        $this->assertEquals($expected, execute($input));
    }

    public function testSentenceWithPunctuationRus()
    {
        $input = 'это <Так> "просто"';
        $expected = 'отэ <Кат> "отсорп"';
        $this->assertEquals($expected, execute($input));
    }


    public function testCompleteWordsEng()
    {
        $input = 'third-part';
        $expected = 'driht-trap';
        $this->assertEquals($expected, execute($input));
    }

    public function testMixedCase()
    {
        $input = 'AbC dEf';
        $expected = 'CbA fEd';
        $this->assertEquals($expected, execute($input));
    }


    public function testNumbersAndSymbols()
    {
        $input = '123 abc!@#';
        $expected = '123 cba!@#';
        $this->assertEquals($expected, execute($input));
    }

    public function testEmptyString()
    {
        $input = '';
        $expected = '';
        $this->assertEquals($expected, execute($input));
    }
}
