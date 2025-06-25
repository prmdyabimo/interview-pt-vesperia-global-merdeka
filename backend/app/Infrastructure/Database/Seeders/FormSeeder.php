<?php

namespace App\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Form 1: Detail Kejadian Risiko Operasional
        DB::table('forms')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'Detail Kejadian Risiko Operasional',
            'type' => 'kejadian',
            'payloads' => json_encode($this->getDetailKejadianPayloads()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Form 2: Detail Kerugian
        DB::table('forms')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'Detail Kerugian',
            'type' => 'kerugian',
            'payloads' => json_encode($this->getDetailKerugianPayloads()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function getDetailKejadianPayloads(): array
    {
        return [
            [
                'label' => 'Bulan Pelaporan',
                'id' => '1617779234-f0oy-phln-ppl0u1qx5',
                'type' => 'radio_button',
                'answer' => [
                    'name' => '',
                    'value' => [
                        [
                            'id' => '1617779275-lt0k-zexz-uol8cts7s',
                            'value' => '',
                            'parent_id' => '1617779234-f0oy-phln-ppl0u1qx5',
                            'label' => 'Januari'
                        ]
                    ]
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'orm_only' => 'no',
                'description' => 'Pilih bulan pelaporan',
                'options' => $this->getBulanOptions(),
                'sub_payloads' => []
            ],
            [
                'label' => 'Quarter',
                'id' => '1617779337-7t2y-gmj9-0nid0p04n',
                'type' => 'radio_button',
                'answer' => [
                    'name' => '',
                    'value' => [
                        [
                            'id' => '1617779355-0s0o-len0-45bnkkise',
                            'value' => '',
                            'parent_id' => '1617779337-7t2y-gmj9-0nid0p04n',
                            'label' => 'Q1'
                        ]
                    ]
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'orm_only' => 'no',
                'description' => 'Pilih Quarter',
                'options' => $this->getQuarterOptions(),
                'sub_payloads' => []
            ],
            [
                'label' => 'Tanggal Kejadian',
                'id' => '1617779372-kgyo-zi4q-a3cxrkbox',
                'type' => 'text',
                'answer' => ['name' => '', 'value' => '2019-01-11'],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'sub_type' => 'date',
                'orm_only' => 'no',
                'description' => 'Isi tanggal kejadian',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Tanggal Ditemukan',
                'id' => '1617779391-zrmm-v4bx-t4eg9g8sq',
                'type' => 'text',
                'answer' => ['name' => '', 'value' => '2020-01-23'],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'sub_type' => 'date',
                'orm_only' => 'no',
                'description' => 'Isi tanggal ditemukan',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Deskripsi Kejadian',
                'id' => '1617779413-vfec-odq8-8m3nm00u7',
                'type' => 'long_text',
                'answer' => [
                    'name' => '',
                    'value' => 'Terdapat selisih angsuran hutang pokok fasilitas pembiayaan a.n PT Mitratel pada sistem arium dibandingkan jadwal pada PK sebesar Rp. 2000 pada 3 periode'
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'orm_only' => 'no',
                'description' => 'Jelaskan dengan detail kronologis kejadian',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Deskripsi Penyebab / Root Cause Terjadinya Kejadian',
                'id' => '1617779435-k7j8-6aai-ma0ye5989',
                'type' => 'long_text',
                'answer' => [
                    'name' => '',
                    'value' => 'Penjadwalan angsuran menggunakan presentase dari nilai pokok saat pencairan, bukan angka nominal sehingga mengakibatkan nilai angsuran per periode menjadi kelebihan 2rb rupiah'
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609227754-u4t8-cck1-w18p7azbr',
                'orm_only' => 'no',
                'description' => 'Jelaskan dengan detail root cause kejadian',
                'options' => [],
                'sub_payloads' => []
            ]
        ];
    }

    private function getDetailKerugianPayloads(): array
    {
        return [
            [
                'label' => 'Terkena Dampak',
                'id' => '1617779535-70rw-phgu-z775zzpti',
                'type' => 'checkbox',
                'answer' => [
                    'name' => '',
                    'value' => [
                        '1617779587-p21t-cv59-eoh4ses9b',
                        '1617779627-v64i-uu1g-oo8n3j93v'
                    ]
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609230421-hnjo-h8h0-xwuwcsu3z',
                'orm_only' => 'no',
                'description' => 'Pilih divisi yang terkena dampak dari risiko ini',
                'options' => $this->getDivisiOptions(),
                'sub_payloads' => []
            ],
            [
                'label' => 'Kerugian Financial',
                'id' => '1619062854-ec0x-333o-6m0mla3t7',
                'type' => 'text',
                'answer' => ['name' => '', 'value' => '-'],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609230421-hnjo-h8h0-xwuwcsu3z',
                'sub_type' => 'amount',
                'orm_only' => 'no',
                'description' => 'Besarnya kerugian financial Perseroan',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Potensial Kerugian Financial',
                'id' => '1619062883-xsov-yboj-1hjgvgasn',
                'type' => 'text',
                'answer' => ['name' => '', 'value' => '6000'],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609230421-hnjo-h8h0-xwuwcsu3z',
                'sub_type' => 'amount',
                'orm_only' => 'no',
                'description' => 'Besarnya kerugian finansial yang diperkirakan akan menjadi kerugian Perseroan',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Status',
                'id' => '1619062915-kswm-8e5b-y9rvij69s',
                'type' => 'text',
                'answer' => ['name' => '', 'value' => 'Recovery'],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609230421-hnjo-h8h0-xwuwcsu3z',
                'sub_type' => 'text',
                'orm_only' => 'no',
                'description' => 'Isi status detail kerugian',
                'options' => [],
                'sub_payloads' => []
            ],
            [
                'label' => 'Kerugian Non-Financial',
                'id' => '1619062939-9vfj-cdbo-0qq6omq7h',
                'type' => 'long_text',
                'answer' => [
                    'name' => '',
                    'value' => 'Perbedaan angsuran hutang pokok antara perjanjian pembiayaan dengan sistem arium, pencatatan outstanding fasilitas pembiayaan menjadi tidak sesuai dengan perjanjian pembiayaan.'
                ],
                'supporting_file' => ['value' => '', 'name' => ''],
                'parent_id' => '1609230421-hnjo-h8h0-xwuwcsu3z',
                'orm_only' => 'no',
                'description' => 'Kejadian risiko operasional yang terjadi pada Perseroan, menimbulkan exposure risiko non finansial misalnya : kesalahan pelaporan kepada Regulator atau risiko reputasi',
                'options' => [],
                'sub_payloads' => []
            ]
        ];
    }

    private function getBulanOptions(): array
    {
        $months = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $options = [];
        $baseIds = [
            '1617779275-lt0k-zexz-uol8cts7s',
            '1617779280-pou9-wkho-qba6nin6p',
            '1617779283-b95b-a1u0-k1zpocq18',
            '1617779287-c4d1-8i7o-ojnjm6785',
            '1617779292-zxjy-3lxb-dqlxw2bd6',
            '1617779295-ol4q-p7fg-5a09kzw7f',
            '1617779299-avms-1jy3-jaawfzp0c',
            '1617779302-xt5m-65sq-m28q8096g',
            '1617779306-rmyq-odw0-55ay4hqy0',
            '1617779308-67lv-na3n-7bgnnq6ne',
            '1617779311-nuy7-u09x-dkni3lfd1',
            '1617779314-guet-4mlw-nhnx4aovu'
        ];

        foreach ($months as $index => $month) {
            $options[] = [
                'id' => $baseIds[$index],
                'value' => '',
                'parent_id' => '1617779234-f0oy-phln-ppl0u1qx5',
                'label' => $month
            ];
        }

        return $options;
    }

    private function getQuarterOptions(): array
    {
        $quarters = ['Q1', 'Q2', 'Q3', 'Q4'];
        $baseIds = [
            '1617779355-0s0o-len0-45bnkkise',
            '1617779357-02of-gmh5-kuif0rcj8',
            '1617779359-j4od-s97w-r72w1tm49',
            '1617779361-8sm6-xjoo-sakjhr9iz'
        ];

        $options = [];
        foreach ($quarters as $index => $quarter) {
            $options[] = [
                'id' => $baseIds[$index],
                'value' => '',
                'parent_id' => '1617779337-7t2y-gmj9-0nid0p04n',
                'label' => $quarter
            ];
        }

        return $options;
    }

    private function getDivisiOptions(): array
    {
        $divisions = [
            'DSP',
            'DSDM',
            'DP2',
            'DPPU1',
            'DPPU2',
            'DAA',
            'DTI',
            'DEPI',
            'DAI',
            'DRE',
            'DPB',
            'DPP',
            'DPPU3',
            'DPOP',
            'DPPIK',
            'DPKMI',
            'DP1',
            'DUS',
            'DJK',
            'DKHI',
            'DUP',
            'DMRT',
            'DELST',
            'DH'
        ];

        $baseIds = [
            '1617779556-3mvh-d9iv-kh72qxxtu',
            '1617779562-yv38-5sn1-s5yzkhmfp',
            '1617779578-2qt5-r0o8-dlk9qxlsv',
            '1617779581-28j9-3c9r-a5e1d2x7g',
            '1617779584-3osm-m16s-u2uihslgj',
            '1617779587-p21t-cv59-eoh4ses9b',
            '1617779590-9spy-03fw-xcejzvd5m',
            '1617779592-tb7a-ev7e-7ga8o3f5z',
            '1617779595-6jcs-0z8h-7b5lvtakm',
            '1617779599-30c3-p3zk-rhfd5gqu8',
            '1617779602-856x-s0b1-07ij6mza6',
            '1617779605-xfci-qphe-n9if07sm0',
            '1617779609-jr1z-24qf-7mgqqgq0o',
            '1617779617-ca6r-an7v-fm2p3ahuq',
            '1617779620-glyc-5tid-1kpiyj0sp',
            '1617779622-n2yl-nnrd-mdg1nofu3',
            '1617779627-v64i-uu1g-oo8n3j93v',
            '1617779630-wf1u-k8ye-fv775qf9d',
            '1617779633-o71u-haze-a55vn0ujg',
            '1617779637-tyin-yy5b-jfjbnw74h',
            '1617779643-0j3i-5r22-ec6wldlg5',
            '1617779645-nzk4-68xe-93wdus35p',
            '1617779651-gind-fqjj-kd9ly0w4k',
            '1619144048-ygkn-6yaf-wlh84ulwg'
        ];

        $options = [];
        foreach ($divisions as $index => $division) {
            $options[] = [
                'id' => $baseIds[$index],
                'value' => '',
                'parent_id' => '1617779535-70rw-phgu-z775zzpti',
                'label' => $division
            ];
        }

        return $options;
    }
}