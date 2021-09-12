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
                'description' => "Bitcoin (BTC) is the world's first cryptocurrency built on distributed ledger (blockchain) with the proof-of-work mechanism that is not backed by any country's central bank or government, it was founded by 'Satoshi Nakamoto', a pseudonym representing an individual or group of individuals, who published the whitepaper in October 31st, 2008.",
                'tag' => 'BTC',
            ],
            'Ethereum' => [
                'logo' => 'ethereum.png',
                'description' => "Ether (ETH) is the native currency that powers the Ethereum platform. Ethereum is a decentralized software platform created by Vitalik Buterin that enables SmartContracts and Distributed Applications (ĐApps) to be built and run without any downtime, fraud, control or interference from a third party. Ethereum is not just a platform but also a programming language (Turing complete) running on a blockchain, helping developers to build and publish distributed applications.",
                'tag' => 'ETH',
            ],
            'Ripple' => [
                'logo' => 'ripple.png',
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus varius, libero vitae accumsan pharetra, nisi risus tincidunt est, in sodales lorem est id ante. Nulla vestibulum vestibulum aliquam. Etiam a tristique ex. Phasellus condimentum lacinia purus, eget malesuada eros egestas nec. Pellentesque lobortis dui sed lorem pharetra imperdiet.",
                'tag' => 'XRP',
            ],

            'Bitcoin Cash' => [
                'logo' => 'bitcoin-cash.png',
                'description' => "Bitcoin Cash (BCH) is a peer-to-peer electronic cash for the Internet. It is fully decentralized, with no central bank and requires no trusted third parties to operate. Bitcoin Cash is the continuation of the Bitcoin project as peer-to-peer digital cash, which seeks to add more transaction capacity to the network. Bitcoin cash is therefore a hard fork of the Bitcoin blockchain ledger, with upgraded consensus rules that allow it to grow and scale. Bitcoin Cash increased and will continue to increase block sizes which thereby increase the potential volume of transactions on the network.",
                'tag' => 'BCH',
            ],
            'Cardano' => [
                'logo' => 'cardano.png',
                'description' => "Cardano (ADA) is a decentralised public blockchain and cryptocurrency project and is fully open source. Cardano is developing a smart contract platform seeks to allow complex programmable transfers of value in a secure and scalable fashion through its unique solutions. It is the first blockchain platform to evolve out of a scientific philosophy and a research-first driven approach.",
                'tag' => 'ADA',
            ],
            'Litecoin' => [
                'logo' => 'litecoin.png',
                'description' => "Litecoin (LTC) is one of the oldest cryptocurrencies in existence founded by Charlie Lee. Litecoin as a cryptocurrency is a fork of Bitcoin, therefore they share many of the same characteristics but LTC benefits from shorter block generation times as it uses a faster payment confirmation schedule and a different cryptographic algorithm. Litecoin also has lower transaction fees than Bitcoin and can be used as a digital currency on the web to pay for goods and services and to play at crypto casinos.",
                'tag' => 'LTC',
            ],
            'NEM' => [
                'logo' => 'nem.png',
                'description' => "XEM is a cryptocurrency that powers the New Economy Movement (NEM) blockchain. NEM’s blockchain platform was designed for scalability and speed. NEM’s permissioned private blockchain delivers the fastest transaction rates for internal ledgers. And its revolutionary consensus mechanism and the Supernode program ensure that NEM’s open, public blockchain can grow without ever compromising throughput or stability.",
                'tag' => 'NEM',
            ],
            'Stellar' => [
                'logo' => 'stellar.png',
                'description' => "XLM is a cryptocurrency that powers the Stellar payment network. Stellar connects financial; institutions and makes it easy to create, send, and trade digital representations of all forms of money: dollars, pesos, bitcoin, stellar lumens and etc.",
                'tag' => 'XLM',
            ],
            'IOTA' => [
                'logo' => 'iota.png',
                'description' => "IOTA is a cryptocurrency built to facilitate microtransactions and data integrity for machines on Internet of Things. IOTA utilizes a quantum-proof Directed Acyclic Graph (DAG), known as the IOTA Tangle. The Tangle charges no fees on transactions and it has no fixed limit to the number of transactions that can be confirmed per second in the network.",
                'tag' => 'MIOTA'
            ],
            'Dash' => [
                'logo' => 'dash.png',
                'description' => "Dash (DASH) is an open source peer-to-peer cryptocurrency. On top of Bitcoin's feature set, it is a cryptocurrency that's designed to make transactions instant, private and secure. Dash's speed and privacy settings are adjustable. Its unique network architecture consists of both regular miners and privileged machines called Masternodes. Dash's decentralized governance and budgeting system makes it a decentralized autonomous organization (DAO).",
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
