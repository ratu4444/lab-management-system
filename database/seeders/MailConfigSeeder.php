<?php

namespace Database\Seeders;

use App\Models\MailConfiguration;
use Illuminate\Database\Seeder;

class MailConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inspection_mail_data = [
            'app_name'      => 'outlook',
            'mail_subject'  => 'Project has just passed an inspection',
            'mail_body'     => 'We have great news. Your project has just passed an inspection. Be sure to check out your Dashboard for what is coming up next in the build process. As always feel free to reach out to us if you have any questions about what to expect.',
        ];

        $mail_configurations_data = [
            $inspection_mail_data
        ];

        MailConfiguration::Insert($mail_configurations_data);
    }
}
