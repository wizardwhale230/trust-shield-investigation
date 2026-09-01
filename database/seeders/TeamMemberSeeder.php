<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {
        $members = [
            [
                'first_name'       => 'James',
                'last_name'        => 'Hartford',
                'job_title'        => 'Senior Recovery Attorney',
                'bio'              => 'James has over 15 years of experience representing victims of complex financial fraud, including cryptocurrency scams and offshore investment schemes. He has successfully recovered millions in assets for clients across three continents.',
                'email'            => 'j.hartford@recoveryfirm.com',
                'phone'            => '+1 (800) 555-0101',
                'years_experience' => 15,
                'specialization'   => 'Crypto Fraud, Investment Fraud',
                'is_active'        => true,
            ],
            [
                'first_name'       => 'Sophia',
                'last_name'        => 'Brennan',
                'job_title'        => 'Lead Forensic Financial Investigator',
                'bio'              => 'Sophia specialises in tracing and recovering funds lost to wire fraud and romance scams. Her forensic accounting background allows her to follow money trails across international jurisdictions with precision.',
                'email'            => 's.brennan@recoveryfirm.com',
                'phone'            => null,
                'years_experience' => 11,
                'specialization'   => 'Wire Fraud, Romance Scams',
                'is_active'        => true,
            ],
            [
                'first_name'       => 'Daniel',
                'last_name'        => 'Okafor',
                'job_title'        => 'Recovery Litigation Counsel',
                'bio'              => 'Daniel leads litigation strategy for clients whose cases require court intervention. He has a strong record in securing injunctions and asset-freezing orders against fraudulent brokers and trading platforms.',
                'email'            => 'd.okafor@recoveryfirm.com',
                'phone'            => '+1 (800) 555-0103',
                'years_experience' => 9,
                'specialization'   => 'Binary Options, Forex Fraud',
                'is_active'        => true,
            ],
            [
                'first_name'       => 'Elena',
                'last_name'        => 'Vasquez',
                'job_title'        => 'Client Relations & Case Manager',
                'bio'              => 'Elena serves as the primary point of contact between clients and the legal team. She ensures every client understands the recovery process and is kept fully informed at every stage of their case.',
                'email'            => 'e.vasquez@recoveryfirm.com',
                'phone'            => null,
                'years_experience' => 6,
                'specialization'   => 'Client Liaison, Case Coordination',
                'is_active'        => true,
            ],
            [
                'first_name'       => 'Marcus',
                'last_name'        => 'Yuen',
                'job_title'        => 'Crypto Asset Recovery Specialist',
                'bio'              => 'Marcus is a certified blockchain analyst with deep expertise in tracing stolen cryptocurrency across decentralised networks. He works closely with exchanges and regulators worldwide to facilitate swift asset recovery.',
                'email'            => 'm.yuen@recoveryfirm.com',
                'phone'            => '+1 (800) 555-0105',
                'years_experience' => 7,
                'specialization'   => 'Cryptocurrency, DeFi Fraud',
                'is_active'        => true,
            ],
        ];

        foreach ($members as $data) {
            TeamMember::create($data);
        }
    }
}
