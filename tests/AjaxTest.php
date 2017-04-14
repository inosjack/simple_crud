<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AjaxTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function testAjaxCreate()
    {
        $this->dontSeeInDatabase('employees', ['email' => 'example@example.com']);

      //test create with empty value
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'',
            'job_title'=>'',
            'email'=>'',
            'salary'=>''],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail');

        //name empty
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'',
            'job_title'=>'example',
            'email'=>'example@gmail.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail');
        //email invlid
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'examplecom',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail');
        //salary Alphabet
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'examplecom',
            'salary'=>'ddddd'],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail');
        //email blank
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail');
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'example@froiden.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('success')->dontSee('fail');
        //cheak duplicate data
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'example@froiden.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail')->dontSee('success');


    }
    public function testAjaxUpadate()
    {
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'example@froiden.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('success')->dontSee('fail');
        //insert vakue cheak
        $employees = \App\Employee::get();
        foreach($employees as $emp)
        {
            $id=$emp['id'];
            $email=$emp['email'];

        }
        $this->visit('/')
            ->see($email);

        //update salary job_title
        $this->post('ajaxemployee/'.$id,['name'=>'example',
            'job_title'=>'change',
            'email'=>'example@froiden.com',
            'salary'=>50000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('success')->dontSee('fail');

        $this->visit('/')
            ->see(50000);
        //email pattern
        $this->post('ajaxemployee/'.$id,['name'=>'example',
            'job_title'=>'change',
            'email'=>'exampl',
            'salary'=>50000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail')->dontSee('success');
        //salary numeric
        $this->post('ajaxemployee/'.$id,['name'=>'example',
            'job_title'=>'change',
            'email'=>'example@froiden.com',
            'salary'=>'alphabet'],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('fail')->dontSee('success');


    }
    public function testpages(){
        //tess index
        $this->visit('/')->dontSee('Whoops')->dontSee('errors');
        $this->visit('/employee')->dontSee('Whoops')->dontSee('errors');
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'example@froiden.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('success')->dontSee('fail');

        $emp = \App\Employee::where("email", "=","example@froiden.com")->first();
        $this->visit('/employee/'.$emp->id)->dontSee('Whoops')->dontSee('errors');

    }

    public function testdelete()
    {
        $this->withoutMiddleware()->post('/ajaxemployee',['name'=>'example',
            'job_title'=>'example',
            'email'=>'example@froiden.com',
            'salary'=>10000],
            ['X-Requested-With' => 'XMLHttpRequest'])->dontSee("Whoops")->see('success')->dontSee('fail');
//      $this->visit('/')
//          ->press('Delete');
        $emp = \App\Employee::where("email", "=","example@froiden.com")->first();
        $id=$emp->id;
        $this->seeInDatabase('employees',['id'=>$id])->post('/delete' ,['id'=>$emp->id],
            ['X-Requested-With' => 'XMLHttpRequest'])
            ->dontSee("Whoops")
            ->see('success')
            ->dontSee('fail')
            ->dontSeeInDatabase('employees', ['id' => $id]);
    }
    protected function sendPost($url,$data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
}
