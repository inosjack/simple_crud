<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('/')->
        see('Employee Details')->dontSee('Whoops');
        //$responce=$this->call('GET', '/');
        //$this->see('');

        //var_dump($responce->getContent());
        //this return all html tag
        // $this->assertEquals('Jayant Soni',$responce->getContent());
        // $this->assertTrue((preg_match('/Jayantsjskjks Soniii/g',$responce->getContent())));
        //$this->assertTrue(strpos($responce->getContent(),'Jayantsjskjks Soniii') !== false);
        //$this->foundtext('Jayant Soni');
    }




    protected $empname="any";
    protected $empemail="any@gmail.com";
    protected $empjob_title="any";
    protected $salary=40000;
    /**
     * A basic test example.
     *
     * @return void
     */

   /* public function testDatabae()
    {
        $this->seeInDatabase('employees',['salary' => 40000]);
    }*/
    public function testStore()
    {
//        $this->visit('/employee')->
//        type($this->empname,'name')->type($this->empjob_title,'job_title')->
//        type($this->empemail,'email')
//            ->type($this->salary,'salary')
//            ->press('AddEmployee')
//            ->dontSee('errors')
//            ->seePageIs('/')
//            ->see($this->empname);


            $this->visit('/employee')
                ->see('Create Empployee')
                ->press('AddEmployee')
                ->see('THE NAME FIELD IS REQUIRED.')
                ->see('THE JOB TITLE FIELD IS REQUIRED.')
                ->see('THE EMAIL FIELD IS REQUIRED.')
                ->see('THE SALARY FIELD IS REQUIRED.')
                ->dontSee("Whoops")
                ->seePageIs('/employee');
        $this->visit('/employee')
            ->see('Create Empployee')
            ->type('abc','name')
            ->type('abc','job_title')
            ->type('abc@gmail.com','email')
            ->type(12345,'salary')
            ->press('AddEmployee')
            ->dontSee("Whoops")
            ->seePageIs('/');
        $this->visit('/employee')
            ->see('Create Empployee')
            ->type('any','name')
            ->type('any','job_title')
            ->type('abc@gmail.com','email')
            ->type("2222",'salary')
            ->press('AddEmployee')
            ->see('THE EMAIL HAS ALREADY BEEN TAKEN.')
            ->dontSee("Whoops")
            ->seePageIs('/employee');


    }
//start edit

    public function testEdit()
    {
        //$employees=\App\Employee::where('id', 26)->get();
        //$response=$this->call('GET' ,'/employee/26');
        //var_dump($response->getContent());
        /* $this->visit('employee/26')->
         type($this->empname,'name')
             ->press('UpdteEmployee')
             ->seePageIs('/');*/
        $employees = \DB::table('employees')->get();
        foreach($employees as $emp)
        {
            $this->visit('/')
                ->see($emp->name)
                ->press('emp'.$emp->id)
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id.'=')
                ->press('UpdteEmployee')
                ->dontSee('errors')
                ->dontSee("Whoops")
                ->seePageIs('/');
        }
        foreach($employees as $emp)
        {
            $this->visit('/')
                ->see($emp->name)
                ->press('emp'.$emp->id)
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id.'=')
                -> type('','name')
                ->type('anyjob','job_title')
                ->type('any@gmail.com','email')
                ->type(123,'salary')
                ->press('UpdteEmployee')
                ->see('THE NAME FIELD IS REQUIRED.')
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id);
            $this->visit('/')
                ->see($emp->name)
                ->press('emp'.$emp->id)
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id.'=')
                ->type('any','name')
                ->type('','job_title')
                ->type('any@gmail.com','email')
                ->type(2222,'salary')
                ->press('UpdteEmployee')
                ->see('THE JOB TITLE FIELD IS REQUIRED.')
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id);
            $this->visit('/')
                ->see($emp->name)
                ->press('emp'.$emp->id)
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id.'=')
                ->type('any','name')
                ->type('any','job_title')
                ->type('','email')
                ->type(2222,'salary')
                ->press('UpdteEmployee')
                ->see('THE EMAIL FIELD IS REQUIRED.')
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id);
            $this->visit('/')
                ->see($emp->name)
                ->press('emp'.$emp->id)
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id.'=')
                ->type('any','name')
                ->type('any@email.com','job_title')
                ->type('kkfhdh','email')
                ->type("22dd22",'salary')
                ->press('UpdteEmployee')
                ->see('THE SALARY MUST BE A NUMBER.')
                ->seePageIs('/employee/'.$emp->id.'?emp'.$emp->id);
        }


    }
    //end edit



    public function testdelete()
    {
//        $this->visit('/')
//            ->press('Delete');
    }
//    public function testDelete()
//    {
//        $employees = \DB::table('employees')->get();
//        foreach ($employees as $emp) {
//            $this->visit('/')
//                ->press('del'.$emp->id)
//                ->seePageIs('/')
//                ->dontSee('abc@gmail.com');
//
//        }
//    }


    protected function foundtext($text)
    {
        $crawler= $this->client->getCrawler();
        $found= $crawler->filter(" body:contains('{$text}')");
        $this->assertGreaterThan(0,count($found),"Expected to see {$text}in view");
    }
    //AjaxTesting.........................




}
