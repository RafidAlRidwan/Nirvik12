<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class sendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $emails = [
            'rafidalridwan@gmail.com',
            'reshadmollick22@gmail.com',
            'shifat01359@gmail.com',
            'habibullahshehab@gmail.com',
            'jubair.sciti@gmail.com',
            'ar.rokon.14.09@gmail.com',
            'tanzilmousuf@gmail.com',
            'sarowarhossain518@gmail.com',
            'mdwaaesarasul12@gmail.com',
            'toushikshish@gmail.com',
            'nibrasulhaque21@gmail.com',
            'moonb8445@gmail.com',
            'maksadur.ru@gmail.com',
            'asifarafat6@gmail.com',
            'shuvo594@gmail.com',
            'tanvirahmed1418@gmail.com',
            'tazmilurrahmanodri@gmail.com',
            'kalabhuna00019@gmail.com',
            'shefathossain39@gmail.com',
            'habibrashidul@gmail.com',
            'rashadul.rashu.1@gmail.com',
            'a.a.muktadir@outlook.com',
            'tanveerahmedabeer07@gmail.com',
            'sagor186@gmail.com',
            'nishatzaman133@gmail.com',
            'zobayerislam1@gmail.com',
            'rrahib130@gmail.com',
            'rownok15@gmail.com',
            'fahimshahariarfhm7@gmail.com',
            'fatinishrak@gmail.com',
            'taufiqhasan138@gmail.com',
            'utshoshams007@gmail.com',
            'taufikulislam2@gmail.com',
            'ruhi1500@gmail.com',
            'rafi9535@gmail.com',
            'subratakuad@gmail.com',
            'salahuddinashik2997@gmail.com',
            'gourob2468@gmail.com',
            'bhmsajeeb@gmail.com',
            'toukirock@gmail.com',
            'nuuhashakando@gmail.com',
            'ratan.kumr450@gmail.com',
            'emsaminanjum008@gmail.com',
            'tsnl.hasan@gmail.com',
            'thasan.ashik@gmail.com',
            'yasir.abrar95@gmail.com',
            'tasrif.mortoza@gmail.com',
            'rhbabla2015@gmail.com',
            'forruk.ahmed13@gmail.com',
            'zamy4lead@gmail.com',
            'rahuldatta446223@gmail.com',
            'nurunnabiislamnishat@gmail.com',
            'mozahedul99@gmail.com',
            'atiqurdvm@gmail.com',
            'abdurrazzakrumon0001@gmail.com',
            'mohiuddin.nirob.mn@gmail.com',
            'shahriar.mashuk.bd@gmail.com',
            'ashiqul33@gmail.com',
            'maroofhasan.364060@gmail.com',
            'anondoislam50@gmail.com',
            'sarshiatullah616@gmail.com',
            'saif.uddinahc@gmail.com',
            'extrakib@gmail.com',
            'rubabmahamud@gmail.com',
            'md.rejwanur.rahman5@gmail.com',
            'sr34097@gmail.com',
            'hossain.mahobub@gmail.com',
            'khantazulislam2@gmail.com',
            'yoyolidoy@gmail.com'
        ];
        $details = [
            'title' => 'Congratulations',
            'body' => '<p>Thanks for sharing your information with us.</p>
            <p>Our official website will be launched soon!</p>
            <p>Hope to meet you all soon, in our upcomming Grand Ifter Mahfil 2023</p>
            ',
        ];
        foreach ($emails as $email) {
            Mail::to($email)->send(new SendEmail($details));
        }
    }
}
