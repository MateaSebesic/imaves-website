<?php
Yii::import('application.controllers.MessageController');

class MessageTest extends CTestCase
{
    public function testRepeat()
    {
        $message = new MessageController('mesageTest');
        $this->assertEquals($message->repeat('Any one out there?'),'Any one out there?');
    }
}

?>