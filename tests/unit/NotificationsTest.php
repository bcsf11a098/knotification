<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Panic\Notifications\Notification;
use Panic\Notifications\Email\MailData;
use Panic\Notifications\SMS\SMSData;
use Panic\Notifications\Push\PushNotificationData;


class NotificationsTest extends PHPUnit_Framework_TestCase
{
    /*public function setUp()
    {
        Eloquent::unguard();
        $db = new DB;
        $db->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
        $db->bootEloquent();
        $db->setAsGlobal();
        $this->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->string('mobile_number');
            $table->string('device_token');
            $table->timestamps();
        });
    }

    public function tearDown()
    {
        $this->schema()->drop('users');
    }*/

    /**
     * @var \Guzzle\Http\Client
     */
    /*private $mailcatcher;

    public function setUp()
    {
        $this->mailcatcher = new \GuzzleHttp\Client(['base_url' => 'http://localhost:1080']);

        // clean emails between tests
        $this->cleanMessages();
    }

    // api calls
    public function cleanMessages()
    {
        $this->mailcatcher->delete('/messages')->send();
    }

    public function getLastMessage()
    {
        $messages = $this->getMessages();
        if (empty($messages)) {
            $this->fail("No messages received");
        }
        // messages are in descending order
        return reset($messages);
    }

    public function getMessages()
    {
        $jsonResponse = $this->mailcatcher->get('/messages')->send();
        return json_decode($jsonResponse->getBody());
    }

    // assertions
    public function assertEmailIsSent($description = '')
    {
        $this->assertNotEmpty($this->getMessages(), $description);
    }

    public function assertEmailSubjectContains($needle, $email, $description = '')
    {
        $this->assertContains($needle, $email->subject, $description);
    }

    public function assertEmailSubjectEquals($expected, $email, $description = '')
    {
        $this->assertContains($expected, $email->subject, $description);
    }

    public function assertEmailHtmlContains($needle, $email, $description = '')
    {
        $response = $this->mailcatcher->get("/messages/{$email->id}.html")->send();
        $this->assertContains($needle, (string)$response->getBody(), $description);
    }

    public function assertEmailTextContains($needle, $email, $description = '')
    {
        $response = $this->mailcatcher->get("/messages/{$email->id}.plain")->send();
        $this->assertContains($needle, (string)$response->getBody(), $description);
    }

    public function assertEmailSenderEquals($expected, $email, $description = '')
    {
        $response = $this->mailcatcher->get("/messages/{$email->id}.json")->send();
        $email = json_decode($response->getBody());
        $this->assertEquals($expected, $email->sender, $description);
    }

    public function assertEmailRecipientsContain($needle, $email, $description = '')
    {
        $response = $this->mailcatcher->get("/messages/{$email->id}.json")->send();
        $email = json_decode($response->getBody());
        $this->assertContains($needle, $email->recipients, $description);
    }

    function testNotificationIsSent()
    {
        // ... trigger notifications

        $email = $this->getLastMessage();
        dd($email);
        $this->assertEmailSenderEquals('<bugira@bugira.com>', $email);
        $this->assertEmailRecipientsContain('<davert@ukr.net>', $email);
        $this->assertEmailSubjectEquals('[Bugira] Ticket #2 has been closed', $email);
        $this->assertEmailSubjectContains('Ticket #2', $email);
        $this->assertEmailHtmlContains('#2 integer pede justo lacinia eget tincidunt', $email);
    }*/
    protected $mail_data;

    protected $sms_data;

    protected $push_data;

    public function setUp()
    {
        $this->mail_data = new MailData('filip@cloudhorizon.com', 'Welcome!', 'This is your first notification!');

        $this->sms_data = new SMSData(array('+381642062558'), 'This is your first notification!');

        $this->push_data = new PushNotificationData('appNameAndroid', array('qwerty','asdfg'), 'This is your first notification!');
    }

    /** @test */
    function mailHasData()
    {
        $this->assertEquals(array('filip@cloudhorizon.com'), $this->mail_data->getEmailsTo());

        $this->assertEquals('Welcome!', $this->mail_data->getSubject());

        $this->assertEquals('This is your first notification!', $this->mail_data->getMessage());

    }

    /** @test */
    function SMSHasData()
    {
        $this->assertEquals(array('+381642062558'), $this->sms_data->getNumbersTo());

        $this->assertEquals('This is your first notification!', $this->sms_data->getMessage());
    }

    /** @test */
    function PushNotificationHasData()
    {
        $this->assertEquals('appNameAndroid', $this->push_data->getAppName());

        $this->assertEquals(array('qwerty','asdfg'), $this->push_data->getDevicesToken());

        $this->assertEquals('This is your first notification!', $this->push_data->getMessage());
    }
}