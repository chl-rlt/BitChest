<?php

namespace Database\Seeders;
use App\Models\Cryptocurrencie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $crypto = [
            'Bitcoin' => [
                'logo' => 'bitcoin.png',
                'description' => "Bitcoin’s price today is USD 48,812.43, with a 24-hour trading volume of USD 39,237,879,932.70. BTC is up 3.15% in the last 24 hours. It is currently -1.57% above its 7-day all-time high of USD 49,593.25, and -1.57% above its 7-day all-time low of USD 49,593.25. BTC has a circulating supply of 18,803,487.00 BTC and a max supply of 21,000,000.00 BTC.
                Bitcoin (BTC) is the world's first cryptocurrency built on distributed ledger (blockchain) with the proof-of-work mechanism that is not backed by any country's central bank or government, it was founded by 'Satoshi Nakamoto', a pseudonym representing an individual or group of individuals, who published the whitepaper in October 31st, 2008.",
                'tag' => 'BTC',
            ],
            'Ethereum' => [
                'logo' => 'ethereum.png',
                'description' => "Ethereum’s price today is USD 3,712.89, with a 24-hour trading volume of USD 30,094,564,549.28. ETH is up 9.96% in the last 24 hours. It is currently -1.06% above its 7-day all-time high of USD 3,752.53, and -1.06% above its 7-day all-time low of USD 3,752.53. ETH has a circulating supply of 117,346,723.56 ETH.
                Ether (ETH) is the native currency that powers the Ethereum platform. Ethereum is a decentralized software platform created by Vitalik Buterin that enables SmartContracts and Distributed Applications (ĐApps) to be built and run without any downtime, fraud, control or interference from a third party. Ethereum is not just a platform but also a programming language (Turing complete) running on a blockchain, helping developers to build and publish distributed applications.",
                'tag' => 'ETH',
            ],
            'Ripple' => [
                'logo' => 'ripple.png',
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus varius, libero vitae accumsan pharetra, nisi risus tincidunt est, in sodales lorem est id ante. Nulla vestibulum vestibulum aliquam. Etiam a tristique ex. Phasellus condimentum lacinia purus, eget malesuada eros egestas nec. Pellentesque lobortis dui sed lorem pharetra imperdiet.",
                'tag' => 'XRP',
            ],

            'Bitcoin Cash' => [
                'logo' => 'bitcoin-cash.png',
                'description' => "Bitcoin Cash’s price today is USD 649.64, with a 24-hour trading volume of USD 3,014,360,461.98. BCH is up 2.22% in the last 24 hours. It is currently -5.87% above its 7-day all-time high of USD 690.17, and -5.87% above its 7-day all-time low of USD 690.17. BCH has a circulating supply of 18,833,900.00 BCH and a max supply of 21,000,000.00 BCH.
                Bitcoin Cash (BCH) is a peer-to-peer electronic cash for the Internet. It is fully decentralized, with no central bank and requires no trusted third parties to operate. Bitcoin Cash is the continuation of the Bitcoin project as peer-to-peer digital cash, which seeks to add more transaction capacity to the network. Bitcoin cash is therefore a hard fork of the Bitcoin blockchain ledger, with upgraded consensus rules that allow it to grow and scale. Bitcoin Cash increased and will continue to increase block sizes which thereby increase the potential volume of transactions on the network.",
                'tag' => 'BCH',
            ],
            'Cardano' => [
                'logo' => 'cardano.png',
                'description' => "Cardano’s price today is USD 2.89, with a 24-hour trading volume of USD 4,623,473,810.47. ADA is up 4.79% in the last 24 hours. It is currently -2.02% above its 7-day all-time high of USD 2.95, and -2.02% above its 7-day all-time low of USD 2.95. ADA has a circulating supply of 32,145,348,141.30 ADA and a max supply of 45,000,000,000.00 ADA.
                Cardano (ADA) is a decentralised public blockchain and cryptocurrency project and is fully open source. Cardano is developing a smart contract platform seeks to allow complex programmable transfers of value in a secure and scalable fashion through its unique solutions. It is the first blockchain platform to evolve out of a scientific philosophy and a research-first driven approach.",
                'tag' => 'ADA',
            ],
            'Litecoin' => [
                'logo' => 'litecoin.png',
                'description' => "Litecoin’s price today is USD 179.60, with a 24-hour trading volume of USD 2,631,861,398.21. LTC is up 5.02% in the last 24 hours. It is currently -1.49% above its 7-day all-time high of USD 182.32, and -1.49% above its 7-day all-time low of USD 182.32. LTC has a circulating supply of 66,752,614.52 LTC and a max supply of 84,000,000.00 LTC.
                Litecoin (LTC) is one of the oldest cryptocurrencies in existence founded by Charlie Lee. Litecoin as a cryptocurrency is a fork of Bitcoin, therefore they share many of the same characteristics but LTC benefits from shorter block generation times as it uses a faster payment confirmation schedule and a different cryptographic algorithm. Litecoin also has lower transaction fees than Bitcoin and can be used as a digital currency on the web to pay for goods and services and to play at crypto casinos.",
                'tag' => 'LTC',
            ],
            'NEM' => [
                'logo' => 'nem.png',
                'description' => "NEM’s price today is USD 0.199024, with a 24-hour trading volume of USD 72,325,002.58. XEM is up 4.05% in the last 24 hours. It is currently -4.75% above its 7-day all-time high of USD 0.208942, and -4.75% above its 7-day all-time low of USD 0.208942. XEM has a circulating supply of 8,999,999,999.00 XEM and a max supply of 8,999,999,999.00 XEM.
                XEM is a cryptocurrency that powers the New Economy Movement (NEM) blockchain. NEM’s blockchain platform was designed for scalability and speed. NEM’s permissioned private blockchain delivers the fastest transaction rates for internal ledgers. And its revolutionary consensus mechanism and the Supernode program ensure that NEM’s open, public blockchain can grow without ever compromising throughput or stability.",
                'tag' => 'NEM',
            ],
            'Stellar' => [
                'logo' => 'stellar.png',
                'description' => "Stellar’s price today is USD 0.354475, with a 24-hour trading volume of USD 727,768,392.68. XLM is up 3.20% in the last 24 hours. It is currently -2.29% above its 7-day all-time high of USD 0.362785, and -2.29% above its 7-day all-time low of USD 0.362785. XLM has a circulating supply of 23,607,534,039.80 XLM and a max supply of 50,001,806,812.00 XLM.",
                'tag' => 'XLM',
            ],
            'IOTA' => [
                'logo' => 'iota.png',
                'description' => "IOTA’s price today is USD 1.14, with a 24-hour trading volume of USD 200,137,680.19. MIOTA is up 15.35% in the last 24 hours. It is currently -1.05% above its 7-day all-time high of USD 1.15, and -1.05% above its 7-day all-time low of USD 1.15. MIOTA has a circulating supply of 2,779,530,283.00 MIOTA and a max supply of 2,779,530,283.00 MIOTA.
                IOTA is a cryptocurrency built to facilitate microtransactions and data integrity for machines on Internet of Things. IOTA utilizes a quantum-proof Directed Acyclic Graph (DAG), known as the IOTA Tangle. The Tangle charges no fees on transactions and it has no fixed limit to the number of transactions that can be confirmed per second in the network.",
                'tag' => 'MIOTA'
            ],
            'Dash' => [
                'logo' => 'dash.png',
                'description' => "Dash’s price today is USD 238.42, with a 24-hour trading volume of USD 335,029,317.42. DASH is up 7.11% in the last 24 hours. It is currently -9.88% above its 7-day all-time high of USD 264.57, and -9.88% above its 7-day all-time low of USD 264.57. DASH has a circulating supply of 10,311,631.27 DASH and a max supply of 18,900,000.00 DASH.
                Dash (DASH) is an open source peer-to-peer cryptocurrency. On top of Bitcoin's feature set, it is a cryptocurrency that's designed to make transactions instant, private and secure. Dash's speed and privacy settings are adjustable. Its unique network architecture consists of both regular miners and privileged machines called Masternodes. Dash's decentralized governance and budgeting system makes it a decentralized autonomous organization (DAO).",
                'tag' => 'DASH',
            ],
        ];




        foreach($crypto as $key => $val) {
            DB::table('cryptocurrencies')->insert(
                [
                    'name' => $key,
                    'logo' => $val['logo'],
                    'description' => $val['description'],
                    'tag' => $val['tag'],
                ],
            );
        }
    }
}
