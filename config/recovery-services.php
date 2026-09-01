<?php

/*
|--------------------------------------------------------------------------
| Recovery Services Catalogue
|--------------------------------------------------------------------------
|
| Single source of truth for all recovery service detail pages.
| Consumed by App\Http\Controllers\RecoveryController.
|
| Schema (all keys other than name/description/icon/category are optional;
| service-detail.blade.php conditionally renders sections that exist):
|
|   'slug' => [
|       'name'          => string  // page title & card heading
|       'description'   => string  // meta + card subtitle (1 sentence)
|       'icon'          => string  // Lucide icon name
|       'category'      => string  // 'trading' | 'online' | 'bank'
|       'hero_image'    => string  // optional Unsplash URL for header
|       'intro'         => string  // 1-2 sentence opener above the body
|       'stats'         => array   // [['value' => '£2.3bn', 'label' => 'Lost in 2024'], ...]
|       'warning_signs' => array   // ['Unsolicited contact...', ...]
|       'process'       => array   // [['icon' => 'search', 'title' => '...', 'desc' => '...'], ...]
|       'content'       => string  // Main HTML body (h2/h3/p/ul/ol/li/a styled by .prose-content)
|       'cta_question'  => string  // Heading for in-body CTA banner
|       'faqs'          => array   // [['question' => '...', 'answer' => '...'], ...]
|       'related'       => array   // [['title' => '...', 'slug' => '...'], ...]
|   ]
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Trading & Investment
    |--------------------------------------------------------------------------
    */

    'trading-scams' => [
        'name' => 'Trading Scams',
        'description' => 'Expert recovery services for victims of trading scams and fraudulent brokers.',
        'icon' => 'trending-up',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Trading scams are now one of the most reported forms of investment fraud in the UK. If you have been pressured into deposits, denied withdrawals, or lured by guaranteed returns, you may have a recoverable claim.',
        'stats' => [
            ['value' => '£612m+', 'label' => 'Lost to investment fraud in the UK in 2024 (Action Fraud)'],
            ['value' => '$30M+', 'label' => 'Recovered for our clients to date'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Unsolicited contact by phone, email, or social media offering an investment opportunity',
            'Promises of guaranteed, high, or risk-free returns',
            'High-pressure tactics urging you to deposit quickly or "before the offer closes"',
            'Refusal, delay, or new "fees" demanded when you try to withdraw',
            'A broker that is not authorised on the FCA register',
            'A new "account manager" frequently being assigned to your case',
            'Requests to install remote-access software (e.g. AnyDesk, TeamViewer)',
        ],
        'process' => [
            ['icon' => 'search',        'title' => 'Investigate',  'desc' => 'We verify the broker, examine your account history, and identify regulatory and contractual breaches.'],
            ['icon' => 'route',         'title' => 'Trace',        'desc' => 'We follow the money through banking and payment-processor records to locate where your funds are now held.'],
            ['icon' => 'gavel',         'title' => 'Pursue',       'desc' => 'We file regulatory complaints, chargeback claims, and legal demands against the responsible parties.'],
            ['icon' => 'banknote',      'title' => 'Recover',      'desc' => 'We negotiate, settle, or litigate to return your funds — keeping you informed at every stage.'],
        ],
        'content' => '
            <h2>How Trading Scams Operate</h2>
            <p>Fraudulent brokers use a familiar playbook: a polished website, a friendly sales call, a small initial deposit, and a quick "win" on a demo trade to build trust. Over weeks or months, victims are pressured into ever-larger deposits, often using leverage they do not fully understand. When they try to withdraw, the firm produces invented tax bills, "release fees," or simply stops responding.</p>

            <h2>Common Variants We See</h2>
            <ul>
                <li><strong>Unregulated CFD and forex brokers</strong> operating from offshore jurisdictions</li>
                <li><strong>Cloned firms</strong> using the name and FCA reference of a legitimate broker</li>
                <li><strong>Signal-selling and "managed account" scams</strong> tied to fraudulent platforms</li>
                <li><strong>Recovery-room fraud</strong> — fake "asset recovery" firms targeting earlier victims</li>
            </ul>

            <h2>The Legal &amp; Regulatory Routes</h2>
            <p>Most claims combine several recovery channels: chargeback or Section 75 claims against the card issuer; complaints to the receiving bank under the Contingent Reimbursement Model (CRM) Code; escalations to the Financial Ombudsman Service (FOS); regulatory complaints to the FCA or the broker\'s home regulator (CySEC, ASIC, BaFin); and, where appropriate, civil action against directors and payment intermediaries.</p>

            <h2>What We Need From You</h2>
            <p>To assess your case quickly, please gather your trading account statements, deposit confirmations, all correspondence with the broker, copies of any contracts you signed, and bank statements showing the outgoing payments. Don\'t worry if anything is missing — we can usually obtain records through subject access requests.</p>
        ',
        'cta_question' => 'Lost money to a trading scam?',
        'faqs' => [
            ['question' => 'How likely am I to recover my money?',           'answer' => 'It depends on the payment method, the time elapsed, and where the funds were sent. Card and bank-transfer victims have the strongest routes; crypto cases are harder but still recoverable in many instances. We give a candid assessment in your free consultation.'],
            ['question' => 'How long does the process take?',                 'answer' => 'Most cases resolve within 3–9 months. Bank complaints and chargebacks can move faster; regulatory escalations take longer.'],
            ['question' => 'How do I check if my broker was regulated?',      'answer' => 'Search the broker\'s name on the FCA Register at register.fca.org.uk. Be cautious of clone firms — verify the contact details on the register match those the broker gave you.'],
            ['question' => 'Will I have to pay anything upfront?',            'answer' => 'The initial consultation is free. Many cases proceed on a no-win-no-fee basis; others involve disbursements or a retainer depending on complexity. We agree fees in writing before any work begins.'],
            ['question' => 'Is it too late if the scam was years ago?',       'answer' => 'Not necessarily. Limitation periods vary depending on the cause of action. Get in touch and we\'ll review the timeline.'],
            ['question' => 'Will the scammers know I\'ve contacted you?',     'answer' => 'No. Our work is confidential and we coordinate with banks and regulators directly. We never tip off the fraudster.'],
        ],
        'related' => [
            ['title' => 'Forex Trading Scams',     'slug' => 'forex-trading-scams'],
            ['title' => 'Cryptocurrency Recovery', 'slug' => 'cryptocurrency'],
            ['title' => 'Binary Option Scams',     'slug' => 'binary-option-scams'],
            ['title' => 'Investment Scams',        'slug' => 'investment-scams'],
        ],
    ],

    'cryptocurrency' => [
        'name' => 'Cryptocurrency & Bitcoin Trading Scams',
        'description' => 'Recovery services for victims of cryptocurrency and bitcoin trading scams.',
        'icon' => 'bitcoin',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1518546305927-5a555bb7020d?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Cryptocurrency is the fastest-growing channel for investment fraud in the UK. Although crypto is harder to recover than card or bank transfers, blockchain forensics and exchange-level KYC mean recovery is far from impossible.',
        'stats' => [
            ['value' => '£306m+', 'label' => 'Lost to crypto investment scams in the UK in 2023'],
            ['value' => '70%',    'label' => 'Of fraudulent crypto eventually touches a regulated exchange'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Promises of guaranteed or unrealistic returns from crypto trading or staking',
            'A celebrity or influencer endorsement that the celebrity later denies',
            'A platform that asks you to deposit crypto rather than fiat',
            'Withdrawal blocked behind a sudden "tax", "liquidity fee", or "verification deposit"',
            'A trading bot or AI platform with no verifiable track record',
            'A new "account manager" pushing you to deposit more',
            'Requests to install AnyDesk or TeamViewer to "help you trade"',
        ],
        'process' => [
            ['icon' => 'search',       'title' => 'Forensic Tracing', 'desc' => 'We follow your funds on-chain through wallets, mixers, and bridges to identify where they ended up.'],
            ['icon' => 'building-2',   'title' => 'Exchange Targeting', 'desc' => 'When funds reach a regulated exchange, we serve formal demands and KYC requests to freeze and identify the recipient.'],
            ['icon' => 'gavel',        'title' => 'Legal Action',     'desc' => 'We use Bankers Trust and Norwich Pharmacal orders, plus civil claims against identified wallet holders.'],
            ['icon' => 'banknote',     'title' => 'Recover',          'desc' => 'We negotiate the return of frozen funds or pursue judgment-based recovery against named defendants.'],
        ],
        'content' => '
            <h2>How Cryptocurrency Scams Work</h2>
            <p>The most common pattern is a fake trading platform that displays fabricated profits. Victims deposit Bitcoin, Ethereum, or USDT, see their balance grow on screen, and then discover they cannot withdraw without paying ever-larger "fees" and "taxes". Other variants include rug-pull tokens, fake staking pools, romance-led crypto scams, and impersonation of real exchanges through clone websites.</p>

            <h2>Why Recovery Is Possible</h2>
            <p>Public blockchains are transparent ledgers. Every movement of your funds is permanently recorded. Even when criminals use mixers or chain-hopping to obscure the trail, modern forensic tools follow the money — and an estimated 70% of stolen crypto eventually flows through a regulated exchange where the recipient can be identified through KYC records.</p>

            <h2>The Legal Tools We Use</h2>
            <ul>
                <li><strong>Bankers Trust orders</strong> compelling exchanges to disclose recipient identities</li>
                <li><strong>Norwich Pharmacal orders</strong> obtaining information from third parties</li>
                <li><strong>Worldwide freezing injunctions</strong> against persons unknown</li>
                <li><strong>Civil fraud claims</strong> once the recipient is identified</li>
                <li><strong>Liaison with international law enforcement</strong> and exchange compliance teams</li>
            </ul>

            <h2>What To Do Right Now</h2>
            <p>Stop all communication with the platform. Do not pay any further "release fees" — that money is also lost. Take screenshots of your account, wallet addresses, and all communications. Note every transaction hash. The earlier you act, the higher the chance funds are still recoverable from the exchange they will eventually pass through.</p>
        ',
        'cta_question' => 'Lost cryptocurrency to a scam?',
        'faqs' => [
            ['question' => 'Can cryptocurrency really be recovered?',          'answer' => 'Yes — in a meaningful proportion of cases. Recovery depends on how quickly you act, the volume of funds, and where they have moved. We give an honest assessment in the initial consultation.'],
            ['question' => 'My funds went to a non-custodial wallet — is it hopeless?', 'answer' => 'No. Funds in non-custodial wallets nearly always move eventually, often to an exchange. We monitor the wallet and act when movement happens.'],
            ['question' => 'How long does crypto recovery take?',                'answer' => 'Typically 4–12 months. Exchange freezes can happen within days; full recovery through legal process takes longer.'],
            ['question' => 'How much can I expect to recover?',                  'answer' => 'It varies widely. Some clients recover most of their loss; others recover a partial amount or nothing. We are upfront about the realistic range for your case.'],
            ['question' => 'Will the scammers know I am pursuing them?',         'answer' => 'Generally not until a freeze is in place. We coordinate quietly with exchanges and the courts to maximise the chance of catching the funds.'],
            ['question' => 'Should I trust a "recovery service" that contacted me first?', 'answer' => 'No. Unsolicited recovery offers are almost always a secondary scam. Always approach a regulated solicitor or recovery firm yourself.'],
        ],
        'related' => [
            ['title' => 'Trading Scams',        'slug' => 'trading-scams'],
            ['title' => 'NFT Scam Recovery',    'slug' => 'nft-scams'],
            ['title' => 'Investment Scams',     'slug' => 'investment-scams'],
            ['title' => 'HyperVerse Scam',      'slug' => 'hyperverse-scam'],
        ],
    ],

    'forex-trading-scams' => [
        'name' => 'Forex Trading Scams',
        'description' => 'Expert recovery services for forex trading fraud and unregulated brokers.',
        'icon' => 'bar-chart-3',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Forex scams are one of the oldest and most prolific forms of investment fraud. Unregulated and offshore brokers promise high returns from currency trading, then make it impossible to withdraw your funds.',
        'stats' => [
            ['value' => '95%',    'label' => 'Of retail forex traders lose money — fraud makes losses near-certain'],
            ['value' => '£40m+',  'label' => 'Recovered for forex-scam victims by our partners'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A broker not on the FCA register or registered offshore (St. Vincent, Marshall Islands, Vanuatu)',
            'Promises of guaranteed profits, copy-trading bots, or "managed" accounts',
            'A small initial "win" used to encourage larger deposits',
            'Refusal to process withdrawals or new fees demanded before release',
            'Aggressive account managers calling you daily',
            'Bonuses with hidden trading-volume conditions that lock your deposit',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'Investigate', 'desc' => 'We verify the broker against the FCA and other regulators and assess regulatory breaches.'],
            ['icon' => 'route',      'title' => 'Trace',       'desc' => 'We follow card, bank, and crypto deposits to the receiving entities and intermediaries.'],
            ['icon' => 'gavel',      'title' => 'Pursue',      'desc' => 'We file chargebacks, FOS complaints, and regulatory escalations in the UK and abroad.'],
            ['icon' => 'banknote',   'title' => 'Recover',     'desc' => 'We negotiate refunds and pursue civil action where evidence supports it.'],
        ],
        'content' => '
            <h2>How Forex Scams Operate</h2>
            <p>Fraudulent forex brokers set up slick websites and use high-pressure call centres to pitch "low-risk" currency trading. After your first deposit, you are shown demo-style winning trades to build confidence. As you deposit more, the platform manipulates the prices you see, generating losses that wipe out your account — or simply blocks withdrawals when you try to take profit.</p>

            <h2>Common Forex Scam Variants</h2>
            <ul>
                <li><strong>Unregulated offshore brokers</strong> registered in non-cooperative jurisdictions</li>
                <li><strong>Clone firms</strong> impersonating FCA-authorised brokers</li>
                <li><strong>Signal sellers</strong> tied to fraudulent platforms via affiliate kickbacks</li>
                <li><strong>Copy-trading and "managed account" frauds</strong> with fake performance histories</li>
                <li><strong>Bonus-trap schemes</strong> requiring impossible trading volume before withdrawal</li>
            </ul>

            <h2>Routes to Recovery</h2>
            <p>Card deposits often qualify for chargeback under Visa/Mastercard rules or Section 75 of the Consumer Credit Act. Bank transfers may be reimbursable under the CRM Code or new PSR rules. Where the broker is regulated in another jurisdiction we file complaints with that regulator (CySEC, ASIC, FSCA). Crypto deposits require blockchain forensics and exchange engagement.</p>
        ',
        'cta_question' => 'Lost money to a fake forex broker?',
        'faqs' => [
            ['question' => 'How do I check if a forex broker is regulated?',  'answer' => 'Search the FCA Register at register.fca.org.uk. Verify the contact details on the register match what the broker gave you to rule out a clone firm.'],
            ['question' => 'I paid by card — can I get my money back?',       'answer' => 'Often yes. Card deposits are protected by chargeback and Section 75 rights, even months after the transaction.'],
            ['question' => 'The broker says I owe "tax" before withdrawing.',  'answer' => 'This is a classic scam tactic. Genuine brokers do not collect tax — that is a matter between you and HMRC. Do not pay anything further.'],
            ['question' => 'Can I claim if the broker is offshore?',           'answer' => 'Yes. Recovery focuses on the payment trail and intermediaries, not just the broker itself.'],
        ],
        'related' => [
            ['title' => 'Trading Scams',                'slug' => 'trading-scams'],
            ['title' => 'Binary Option Scams',          'slug' => 'binary-option-scams'],
            ['title' => 'Regulated Broker Recovery',    'slug' => 'regulated-broker-recovery'],
            ['title' => 'Boiler Room Fraud',            'slug' => 'boiler-room-fraud'],
        ],
    ],

    'investment-scams' => [
        'name' => 'Investment Scams',
        'description' => 'Recovery services for victims of fraudulent investment schemes.',
        'icon' => 'wallet',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Investment fraud cost UK consumers over £600m in 2023. From bogus bonds to fake green-energy schemes, fraudsters target savers, pensioners, and inexperienced investors with sophisticated, professional-looking pitches.',
        'stats' => [
            ['value' => '£612m', 'label' => 'Lost to investment fraud in the UK in 2023'],
            ['value' => '£17,500', 'label' => 'Average loss per investment-fraud victim'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A cold call, email, or social-media message offering an investment opportunity',
            'High or guaranteed returns with little or no risk',
            'Pressure to decide quickly or before a "deadline"',
            'A firm not on the FCA register, or a clone of a real firm',
            'Glossy brochures and websites but no audited accounts',
            'Requests to invest through unusual payment methods (crypto, gold, escrow)',
        ],
        'process' => [
            ['icon' => 'file-search', 'title' => 'Assess',  'desc' => 'We review the scheme, contracts, and your communications to identify breaches and recovery routes.'],
            ['icon' => 'route',       'title' => 'Trace',   'desc' => 'We follow your funds through banks, crypto, and intermediaries to locate where they sit now.'],
            ['icon' => 'gavel',       'title' => 'Pursue',  'desc' => 'We file regulatory complaints, FSCS claims where applicable, and civil action against directors and intermediaries.'],
            ['icon' => 'banknote',    'title' => 'Recover', 'desc' => 'We negotiate settlements or pursue judgments to return your funds.'],
        ],
        'content' => '
            <h2>Common Investment Scam Types</h2>
            <ul>
                <li><strong>Bond fraud</strong> — fake "mini-bonds" or "corporate bonds" with promised returns of 8–12%</li>
                <li><strong>Green-energy scams</strong> — solar, carbon credits, biofuel, EV-charging schemes</li>
                <li><strong>Wine, whisky, and art investment fraud</strong></li>
                <li><strong>Property and overseas land schemes</strong></li>
                <li><strong>Crypto and trading platforms</strong> dressed up as managed investments</li>
                <li><strong>Cloned regulated firms</strong> using the name and FCA reference of legitimate businesses</li>
            </ul>

            <h2>Your Recovery Options</h2>
            <p>Recovery depends on the scheme structure and your payment method. Card payments and bank transfers have the strongest routes through chargebacks, the CRM Code, and PSR reimbursement. If a regulated firm was involved (or a cloned one), the Financial Services Compensation Scheme (FSCS) may pay up to £85,000. Where directors or intermediaries can be identified, civil action is often viable.</p>

            <h2>What To Bring Us</h2>
            <p>All contracts, brochures, emails, and bank statements showing the payments. Don\'t worry if you don\'t have everything — we can obtain records through subject access and disclosure procedures.</p>
        ',
        'cta_question' => 'Caught up in an investment scam?',
        'faqs' => [
            ['question' => 'How do I check if an investment firm is regulated?', 'answer' => 'Search the FCA Register at register.fca.org.uk and the FCA\'s ScamSmart warning list. Verify the contact details — clone firms use real reference numbers but fake contact details.'],
            ['question' => 'Can I claim from the FSCS?',                          'answer' => 'Yes if a regulated firm or its agent was involved. The FSCS protects up to £85,000 per claim. We handle the application end-to-end.'],
            ['question' => 'What if the firm has gone into administration?',      'answer' => 'You can still claim through the FSCS, the administrator, and where appropriate against directors and connected persons.'],
            ['question' => 'How long do I have to claim?',                        'answer' => 'Most claims must be brought within six years. Some routes have shorter limits. Get advice as early as possible.'],
        ],
        'related' => [
            ['title' => 'Trading Scams',     'slug' => 'trading-scams'],
            ['title' => 'Ponzi Fraud',       'slug' => 'ponzi-fraud'],
            ['title' => 'Pension Scams',     'slug' => 'pension-scams'],
            ['title' => 'Boiler Room Fraud', 'slug' => 'boiler-room-fraud'],
        ],
    ],

    'nft-scams' => [
        'name' => 'NFT Scam Recovery',
        'description' => 'Recovery for NFT and digital asset fraud, rug pulls, and wallet drains.',
        'icon' => 'image',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'NFT fraud exploded alongside the digital-collectibles market and never went away. From rug-pull projects and fake mint sites to phishing drains that empty entire wallets, victims often lose six-figure sums in minutes.',
        'stats' => [
            ['value' => '$100m+', 'label' => 'Stolen through NFT scams in a single recent year'],
            ['value' => 'Minutes', 'label' => 'Speed at which a wallet drain can occur'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A new project promising guaranteed roadmap returns or "floor" growth',
            'A mint or airdrop link from an unverified Discord, Twitter, or email',
            'A request to "verify" or "sync" your wallet at a website',
            'A "free" NFT in your wallet you didn\'t buy — a common phishing lure',
            'An offer to buy your NFT through a custom contract',
            'Team that goes silent or anonymises wallets shortly after launch',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'Trace',    'desc' => 'We map the on-chain movement of your stolen assets and any drained tokens.'],
            ['icon' => 'building-2', 'title' => 'Engage',   'desc' => 'We notify marketplaces (OpenSea, Blur, Magic Eden) and exchanges to flag and freeze the assets.'],
            ['icon' => 'gavel',      'title' => 'Pursue',   'desc' => 'We obtain disclosure orders against exchanges and pursue identified parties.'],
            ['icon' => 'banknote',   'title' => 'Recover',  'desc' => 'We negotiate or litigate to return assets, plus pursue the marketplace where duty-of-care failed.'],
        ],
        'content' => '
            <h2>How NFT Scams Work</h2>
            <p>The NFT space combines the anonymity of crypto with the hype of speculative collectibles, creating ideal conditions for fraud. The most common variants are rug pulls (where a project takes mint funds and disappears), wallet drains (where a malicious smart-contract signature empties your wallet), phishing mint sites, and impersonation of real artists or brands.</p>

            <h2>Recovery Routes</h2>
            <ul>
                <li>Marketplace freeze requests for stolen NFTs that get listed for sale</li>
                <li>Exchange-level interception when proceeds are off-ramped to fiat</li>
                <li>Disclosure orders to identify wallet holders</li>
                <li>Civil claims against identified developers and promoters</li>
            </ul>

            <h2>Act Fast</h2>
            <p>NFT recovery is highly time-sensitive. Stolen assets are often re-listed and sold within hours. Contact us as soon as you spot the loss, and do not interact further with the wallet — moving the remaining funds may complicate tracing.</p>
        ',
        'cta_question' => 'Lost NFTs or had your wallet drained?',
        'faqs' => [
            ['question' => 'My NFT was sold to someone else — is it gone forever?', 'answer' => 'Not necessarily. We can request marketplace freezes against further resale and pursue the on-chain trail to identify the original thief.'],
            ['question' => 'Can you recover assets sent to a hardware wallet?',     'answer' => 'Recovery depends on whether the assets later move to an exchange or marketplace. Static wallet balances are harder but not impossible.'],
            ['question' => 'Do you handle rug-pull projects?',                       'answer' => 'Yes, particularly where the founders can be identified through KYC, on-chain links, or off-chain disclosures.'],
        ],
        'related' => [
            ['title' => 'Cryptocurrency Recovery', 'slug' => 'cryptocurrency'],
            ['title' => 'Investment Scams',        'slug' => 'investment-scams'],
            ['title' => 'Phishing Scams',          'slug' => 'phishing-scams'],
        ],
    ],

    'pension-scams' => [
        'name' => 'Pension Scams',
        'description' => 'Recovery for pension liberation fraud, SIPP mis-selling, and rogue transfer schemes.',
        'icon' => 'landmark',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1556742400-b5b7c5121f7c?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'A pension scam can erase decades of retirement savings in a single transfer. We help victims of pension liberation, SIPP mis-selling, and unregulated overseas transfer schemes recover their lost funds.',
        'stats' => [
            ['value' => '£75,000', 'label' => 'Average loss per pension-fraud victim'],
            ['value' => 'Up to £85k', 'label' => 'FSCS protection per regulated firm'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Cold call, text, or email about your pension (banned by law since 2019)',
            'Promise of unusually high returns or "guaranteed" pension performance',
            'Offer to access your pension before age 55 ("pension liberation")',
            'Pressure to act quickly to "avoid losing the opportunity"',
            'Recommended SIPP holding unregulated, exotic, or overseas investments',
            'Adviser introducer not on the FCA register',
        ],
        'process' => [
            ['icon' => 'file-search', 'title' => 'Review',    'desc' => 'We analyse your pension transfer paperwork, advice records, and the destination scheme.'],
            ['icon' => 'shield-alert','title' => 'Identify',  'desc' => 'We identify the regulated parties who facilitated the transfer and any breach of duty.'],
            ['icon' => 'gavel',       'title' => 'Claim',     'desc' => 'We pursue FOS, FSCS, ceding scheme, and direct civil claims as appropriate.'],
            ['icon' => 'banknote',    'title' => 'Recover',   'desc' => 'We secure compensation up to £85,000 per regulated firm via FSCS, plus uncapped FOS awards.'],
        ],
        'content' => '
            <h2>How Pension Scams Work</h2>
            <p>Most pension scams begin with an introducer offering a "free pension review". The victim is then advised to transfer their existing pension into a self-invested personal pension (SIPP) holding unregulated investments — overseas property, storage pods, green-energy schemes, or carbon credits — that go on to fail. Others involve outright pension liberation, where funds are accessed before age 55 in breach of HMRC rules, triggering tax charges of up to 55% on top of the loss.</p>

            <h2>Routes to Recovery</h2>
            <ul>
                <li><strong>FOS complaints</strong> against the regulated SIPP provider for accepting unsuitable assets</li>
                <li><strong>FSCS claims</strong> against failed regulated advisers (up to £85,000)</li>
                <li><strong>Civil claims</strong> against unregulated introducers and scheme operators</li>
                <li><strong>HMRC liaison</strong> to challenge unauthorised payment charges where the victim was deceived</li>
            </ul>
        ',
        'cta_question' => 'Lost your pension to a scam?',
        'faqs' => [
            ['question' => 'My adviser was unregulated — am I out of luck?', 'answer' => 'Not necessarily. The regulated SIPP provider that received your transfer may still be liable for failing to check the suitability of the destination investments.'],
            ['question' => 'Will the FSCS pay out?',                          'answer' => 'If a regulated firm was involved and is now in default, yes — up to £85,000 per firm.'],
            ['question' => 'I am facing an HMRC tax bill — can you help?',    'answer' => 'Yes. Where the transfer was procured by deception we can challenge the unauthorised-payment charges alongside the recovery claim.'],
        ],
        'related' => [
            ['title' => 'Investment Scams', 'slug' => 'investment-scams'],
            ['title' => 'Ponzi Fraud',      'slug' => 'ponzi-fraud'],
            ['title' => 'Boiler Room Fraud','slug' => 'boiler-room-fraud'],
        ],
    ],

    'binary-option-scams' => [
        'name' => 'Binary Option Scams',
        'description' => 'Recovery for binary-options trading fraud — banned in the UK but still operating offshore.',
        'icon' => 'toggle-right',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Binary options were banned for retail UK consumers by the FCA in 2018 after defrauding billions worldwide. Despite the ban, offshore platforms continue to target UK residents online.',
        'stats' => [
            ['value' => '$10bn+', 'label' => 'Estimated global losses to binary-option fraud'],
            ['value' => '2018',   'label' => 'Year binary options were banned by the FCA for UK retail'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A platform offering "yes/no" trades on price movements',
            'Promised payouts of 70–90% on short-duration trades',
            'A platform based offshore (Israel, Cyprus, Marshall Islands)',
            'Aggressive account managers pushing larger deposits',
            'Withdrawals blocked behind "trading volume" or "verification" requirements',
        ],
        'process' => [
            ['icon' => 'search',   'title' => 'Investigate', 'desc' => 'We identify the operating entity behind the platform — often hidden behind multiple shells.'],
            ['icon' => 'route',    'title' => 'Trace',       'desc' => 'We follow the deposit trail through cards, wires, and crypto.'],
            ['icon' => 'gavel',    'title' => 'Pursue',      'desc' => 'We file chargebacks, regulatory complaints, and civil action where directors are identifiable.'],
            ['icon' => 'banknote', 'title' => 'Recover',     'desc' => 'We secure refunds via card networks and bank complaints, plus pursue judgments where viable.'],
        ],
        'content' => '
            <h2>Why Binary Options Are Banned</h2>
            <p>The FCA found that binary options were essentially gambling products dressed up as investments, with platform operators routinely manipulating prices and refusing withdrawals. The vast majority of retail clients lost money, and the products met none of the criteria expected of regulated investments.</p>

            <h2>Recovery Despite the Ban</h2>
            <p>The ban actually helps recovery. Card networks treat binary-options merchants as high-risk and chargebacks are widely upheld. Receiving banks face increased scrutiny under know-your-customer rules. Where the operator can be identified — and many trace back to a small number of operators — civil action becomes viable.</p>
        ',
        'cta_question' => 'Lost money to a binary-options platform?',
        'faqs' => [
            ['question' => 'I traded after the ban — can I still claim?',      'answer' => 'Yes. The ban actually strengthens your position, particularly for chargebacks and bank complaints.'],
            ['question' => 'How far back can I claim?',                         'answer' => 'Card chargebacks have time limits (typically 120–540 days), but other routes (FOS, civil action) extend much further.'],
            ['question' => 'The platform claims I signed a waiver.',           'answer' => 'Waivers do not protect operators from regulatory breaches or fraud. We can usually challenge them.'],
        ],
        'related' => [
            ['title' => 'Trading Scams',       'slug' => 'trading-scams'],
            ['title' => 'Forex Trading Scams', 'slug' => 'forex-trading-scams'],
            ['title' => 'Boiler Room Fraud',   'slug' => 'boiler-room-fraud'],
        ],
    ],

    'boiler-room-fraud' => [
        'name' => 'Boiler Room Fraud',
        'description' => 'Recovery from high-pressure cold-call investment scams selling worthless shares and bonds.',
        'icon' => 'phone-call',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Boiler room scams use teams of trained, high-pressure salespeople to cold-call victims and sell worthless or wildly overpriced shares, bonds, and investments. Despite being well-known, they still cost UK savers tens of millions every year.',
        'stats' => [
            ['value' => '£200m+', 'label' => 'Estimated annual UK losses to boiler-room fraud'],
            ['value' => 'Hours', 'label' => 'Typical pressure window before "the offer expires"'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'An unsolicited cold call or email offering an investment',
            'High-pressure sales tactics and "limited window" deadlines',
            'Glossy brochures arriving by post or email after the call',
            'Investment in obscure overseas shares, mini-bonds, wine, or commodities',
            'A firm not on the FCA register or claiming to be "FCA exempt"',
            'Refusal to send written information before payment',
        ],
        'process' => [
            ['icon' => 'search',   'title' => 'Identify',  'desc' => 'We map the firm and any connected entities or directors behind the boiler room.'],
            ['icon' => 'route',    'title' => 'Trace',     'desc' => 'We follow your payments through banks and intermediaries.'],
            ['icon' => 'gavel',    'title' => 'Pursue',    'desc' => 'We file regulatory complaints, FOS escalations, and civil action against identifiable directors.'],
            ['icon' => 'banknote', 'title' => 'Recover',   'desc' => 'We secure recovery via the receiving bank, FSCS, or civil judgment.'],
        ],
        'content' => '
            <h2>How Boiler Rooms Operate</h2>
            <p>Boiler rooms run from call centres often based abroad, working from leads bought on the dark web. Trained closers build rapport over weeks, gradually escalating the pitch from "information" to "opportunity" to "limited allocation". Successful victims are passed up the chain to senior closers who push for ever-larger sums.</p>

            <h2>Why Recovery Is Possible</h2>
            <p>The bank that received your payment had duties to check the merchant against fraud lists. The FCA may have published warnings about the firm. The directors may be identifiable. Each of these creates a recovery route, and we pursue all of them in parallel.</p>
        ',
        'cta_question' => 'Pressured into an investment by a cold call?',
        'faqs' => [
            ['question' => 'Will the FOS help me?', 'answer' => 'Likely yes if a UK regulated bank or firm was involved at any stage.'],
            ['question' => 'The firm is overseas — can I still recover?', 'answer' => 'Yes. UK banks, payment processors, and intermediaries remain liable, and we pursue them.'],
            ['question' => 'I gave them more money to "unlock" my account.', 'answer' => 'A common second-stage tactic. Stop all further payments and contact us immediately.'],
        ],
        'related' => [
            ['title' => 'Investment Scams',     'slug' => 'investment-scams'],
            ['title' => 'Pump and Dump Scams',  'slug' => 'pump-and-dump-scams'],
            ['title' => 'Land Banking Fraud',   'slug' => 'land-banking-fraud'],
        ],
    ],

    'pump-and-dump-scams' => [
        'name' => 'Pump and Dump Scams',
        'description' => 'Recovery from coordinated stock and crypto market manipulation schemes.',
        'icon' => 'arrow-up-down',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1535320903710-d993d3d77d29?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Pump-and-dump schemes orchestrate coordinated buying to inflate the price of an obscure share or crypto token, then sell at the top — leaving late buyers with worthless holdings. Social media has supercharged this old fraud.',
        'stats' => [
            ['value' => '90%',    'label' => 'Of pumped tokens lose nearly all value within hours of the dump'],
            ['value' => '$2bn+',  'label' => 'Estimated annual losses to crypto pump-and-dump alone'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Hyped messaging about an obscure stock or token in Telegram, Discord, or WhatsApp groups',
            '"Insider" tips with a specific buy time or target price',
            'Sudden volume spike on a thinly traded asset',
            'Influencer endorsements with no risk disclosures',
            'Pressure to buy quickly "before the news drops"',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'Investigate', 'desc' => 'We identify the orchestrators of the scheme through trading patterns and social-media records.'],
            ['icon' => 'route',      'title' => 'Trace',       'desc' => 'We follow the proceeds through exchanges and wallets to identify the dumpers.'],
            ['icon' => 'gavel',      'title' => 'Pursue',      'desc' => 'We file regulatory complaints with the FCA and SEC and civil action where viable.'],
            ['icon' => 'banknote',   'title' => 'Recover',     'desc' => 'We pursue recovery from identified orchestrators and any negligent platforms.'],
        ],
        'content' => '
            <h2>How Pump-and-Dump Schemes Work</h2>
            <p>Organisers accumulate a position in an obscure asset at low prices. They then orchestrate a coordinated buying campaign — through paid influencers, Telegram groups, and bot networks — to drive the price up. As soon as the rally peaks, they sell into the buying pressure, leaving late participants with collapsing holdings.</p>

            <h2>Recovery Routes</h2>
            <p>Where the orchestrators are identifiable (often through on-chain analysis or paid-promotion records), civil claims for market manipulation become viable. Regulatory action by the FCA or SEC can also drive disgorgement of proceeds.</p>
        ',
        'cta_question' => 'Caught out by a pump-and-dump?',
        'faqs' => [
            ['question' => 'Is this even illegal?', 'answer' => 'Yes. Coordinated market manipulation is a criminal offence under UK and US securities law.'],
            ['question' => 'How do you find the organisers?', 'answer' => 'On-chain analysis, social-media archives, and paid-promotion contracts often expose them.'],
        ],
        'related' => [
            ['title' => 'Cryptocurrency Recovery', 'slug' => 'cryptocurrency'],
            ['title' => 'Boiler Room Fraud',       'slug' => 'boiler-room-fraud'],
            ['title' => 'Investment Scams',        'slug' => 'investment-scams'],
        ],
    ],

    'land-banking-fraud' => [
        'name' => 'Land Banking Fraud',
        'description' => 'Recovery from land-banking investment fraud — small plots sold with false planning promises.',
        'icon' => 'map-pin',
        'category' => 'trading',
        'hero_image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Land banking schemes sell investors small plots of agricultural or greenbelt land with false promises that planning permission is imminent. The truth is usually that planning will never be granted — leaving investors with unsellable plots worth a fraction of what they paid.',
        'stats' => [
            ['value' => '£200m+', 'label' => 'Estimated UK losses to land-banking fraud'],
            ['value' => '<5%',    'label' => 'Of plots ever achieve planning permission'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Cold call or unsolicited email about "strategic land" investment',
            'Claims of imminent planning permission or rezoning',
            'Pressure to buy quickly before the "price rise"',
            'A plot priced far above local agricultural values',
            'A scheme operated as a Collective Investment Scheme without FCA authorisation',
        ],
        'process' => [
            ['icon' => 'file-search', 'title' => 'Review',  'desc' => 'We assess the contracts, planning history, and FCA status of the operator.'],
            ['icon' => 'shield-alert','title' => 'Identify','desc' => 'We identify breaches of FCA rules around unauthorised collective investment schemes.'],
            ['icon' => 'gavel',       'title' => 'Pursue',  'desc' => 'We file FCA complaints, FSCS claims where applicable, and civil action against operators.'],
            ['icon' => 'banknote',    'title' => 'Recover', 'desc' => 'We secure FSCS payouts and judgment-based recovery against directors.'],
        ],
        'content' => '
            <h2>How Land Banking Frauds Work</h2>
            <p>Operators buy a large field cheaply, divide it into hundreds of small plots, and sell each plot at many times its true value. The pitch always involves a story about imminent rezoning. In nearly every case, the land is greenbelt or otherwise protected, planning permission is never granted, and the plots remain unsellable on the open market.</p>

            <h2>The Legal Position</h2>
            <p>Operating an unauthorised collective investment scheme is a criminal offence. The FCA and HMRC have shut down many land-banking operators, often returning some funds to investors through court-appointed liquidators. The FSCS may also pay out where regulated parties were involved.</p>
        ',
        'cta_question' => 'Bought a plot that has not delivered?',
        'faqs' => [
            ['question' => 'Can I still recover years later?',           'answer' => 'Often yes. Many land-banking operators are subject to liquidation processes that allow late claims.'],
            ['question' => 'I own the land — does that mean I am fine?', 'answer' => 'Not necessarily. The land\'s market value is usually far below what you paid, and the loss is recoverable from the operator.'],
        ],
        'related' => [
            ['title' => 'Investment Scams',  'slug' => 'investment-scams'],
            ['title' => 'Boiler Room Fraud', 'slug' => 'boiler-room-fraud'],
            ['title' => 'Ponzi Fraud',       'slug' => 'ponzi-fraud'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Online Fraud
    |--------------------------------------------------------------------------
    */

    'phishing-scams' => [
        'name' => 'Phishing Scams',
        'description' => 'Recovery for victims of phishing attacks, credential theft, and fake banking emails.',
        'icon' => 'fish',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Phishing remains the gateway to most modern financial fraud. A single click on a fake bank email can lead to drained accounts, fraudulent loans, and identity theft — but the bank often shares responsibility for the loss.',
        'stats' => [
            ['value' => '70%+', 'label' => 'Of cyber-enabled fraud begins with a phishing email or text'],
            ['value' => 'Minutes', 'label' => 'Time between credential theft and account drain'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'An email or text claiming to be from your bank, HMRC, Royal Mail, or a delivery firm',
            'A link to log in, verify, or update payment details',
            'Urgency: "your account will be suspended" or "final notice"',
            'Slightly off sender addresses or shortened links',
            'A call shortly after the message claiming to be from "fraud" or "security"',
            'A request to read out one-time passcodes or move funds to a "safe account"',
        ],
        'process' => [
            ['icon' => 'file-text', 'title' => 'Document', 'desc' => 'We capture the phishing artefact and the bank\'s actions to build the complaint file.'],
            ['icon' => 'shield-alert','title' => 'Assess', 'desc' => 'We identify failures in the bank\'s anti-fraud controls and Confirmation of Payee process.'],
            ['icon' => 'gavel',     'title' => 'Pursue',   'desc' => 'We file CRM Code, PSR, and FOS complaints to compel reimbursement.'],
            ['icon' => 'banknote',  'title' => 'Recover',  'desc' => 'We secure refunds and pursue the receiving bank where applicable.'],
        ],
        'content' => '
            <h2>How Phishing Leads to Financial Loss</h2>
            <p>The classic pattern: you receive a fake email or text, click the link, and unknowingly enter your banking credentials on a clone website. Within minutes, the criminals log in, set up a new payee, and drain the account. More sophisticated variants combine phishing with a follow-up call from a fake "fraud officer" who walks you through authorising payments to a "safe account".</p>

            <h2>Why Banks Are Often Liable</h2>
            <ul>
                <li>Failure to flag unusual login activity or new-payee transactions</li>
                <li>Failure to apply or honour Confirmation of Payee warnings</li>
                <li>Failure to identify the criminal call as part of the same fraud</li>
                <li>Failure to recover funds quickly enough from the receiving bank</li>
            </ul>

            <h2>What To Do Immediately</h2>
            <p>Call your bank from the number on the back of your card — not any number given by the caller. Change passwords from a clean device. Report to Action Fraud. Then contact us to begin the recovery process.</p>
        ',
        'cta_question' => 'Lost money after clicking a phishing link?',
        'faqs' => [
            ['question' => 'I gave them my passcode — will the bank still refund me?', 'answer' => 'Often yes. Under the new PSR rules and the CRM Code, banks must reimburse blameless victims of impersonation fraud, including where deception led you to share security details.'],
            ['question' => 'How long do I have to claim?',                            'answer' => 'Report to your bank immediately. Formal complaints generally have a six-year window, with six months to escalate to FOS after a final response.'],
            ['question' => 'My bank closed my account — can you still help?',         'answer' => 'Yes. Account closure does not affect your right to claim against the bank for the fraud loss.'],
            ['question' => 'What if the criminal had already opened loans in my name?', 'answer' => 'Identity-fraud loans can be challenged with the lender and credit reference agencies. We handle this alongside the main claim.'],
        ],
        'related' => [
            ['title' => 'Impersonation Scams',  'slug' => 'impersonation-scams'],
            ['title' => 'Spoofing Fraud',       'slug' => 'spoofing-fraud'],
            ['title' => 'Bank Fraud',           'slug' => 'bank-fraud'],
            ['title' => 'AI Scams',             'slug' => 'ai-scams'],
        ],
    ],

    'romance-fraud' => [
        'name' => 'Romance Fraud & Scams',
        'description' => 'Confidential, sensitive recovery for victims of online romance and dating fraud.',
        'icon' => 'heart',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Romance fraud is uniquely cruel — it weaponises trust, hope, and intimacy. UK victims lose tens of millions each year to fraudsters who build elaborate fake relationships before asking for money. We approach every case with discretion and without judgement.',
        'stats' => [
            ['value' => '£92m+',  'label' => 'Reported lost to romance fraud in the UK in 2023'],
            ['value' => '£11,500', 'label' => 'Average loss per romance-fraud victim'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A connection that develops unusually quickly online',
            'A partner who refuses to video call or always has an excuse',
            'A profession that explains being abroad or unreachable (military, oil rig, doctor on mission)',
            'A request for money to handle an emergency, customs, hospital, or business deal',
            'A request you keep the relationship secret from family',
            'Repeated requests for ever-larger sums',
        ],
        'process' => [
            ['icon' => 'lock',        'title' => 'Confidential Intake', 'desc' => 'We take your account in full confidence — no judgement, no blame.'],
            ['icon' => 'route',       'title' => 'Trace',               'desc' => 'We follow your payments through banks, money-transfer services, and crypto exchanges.'],
            ['icon' => 'gavel',       'title' => 'Pursue',              'desc' => 'We file CRM Code and PSR claims, plus civil action against identifiable recipients.'],
            ['icon' => 'banknote',    'title' => 'Recover',             'desc' => 'We secure reimbursement and any further recovery from receiving banks and intermediaries.'],
        ],
        'content' => '
            <h2>How Romance Fraud Works</h2>
            <p>Fraudsters operate from organised call-centres, often using stolen photographs and AI-generated profiles. They invest weeks or months in building a connection before introducing the first request for money — always emotionally framed as an emergency or opportunity. Victims who pay are kept on the hook for as long as funds last, then often re-approached as part of a "recovery" scam.</p>

            <h2>Your Right To Reimbursement</h2>
            <p>Romance fraud is now firmly recognised as authorised push payment fraud. Under the PSR mandatory reimbursement scheme that came into force in October 2024, victims are entitled to refunds up to £85,000 per claim. The CRM Code provides similar protection for older losses.</p>

            <h2>You Are Not Alone</h2>
            <p>Romance fraud victims often feel embarrassed and isolated. We deal with hundreds of these cases. The criminals are organised professionals — falling for them is not a failure of intelligence. We focus on getting your money back, with discretion at every step.</p>
        ',
        'cta_question' => 'Affected by romance fraud?',
        'faqs' => [
            ['question' => 'Will my family find out?',                  'answer' => 'Not from us. We work entirely through you and your bank — your case is fully confidential.'],
            ['question' => 'I\'m embarrassed — do I have to relive it all?', 'answer' => 'We need the basic facts to build the claim, but we do not require you to share more than is necessary. Many of our clients tell us the process is less difficult than they feared.'],
            ['question' => 'I sent crypto, not bank transfers — can I still claim?', 'answer' => 'Yes. Crypto is harder to recover but on-chain tracing combined with exchange engagement often produces results.'],
            ['question' => 'They are still in touch — should I block them?', 'answer' => 'Speak with us first. Sometimes preserving contact briefly helps secure evidence for the claim.'],
        ],
        'related' => [
            ['title' => 'Impersonation Scams', 'slug' => 'impersonation-scams'],
            ['title' => 'Phishing Scams',      'slug' => 'phishing-scams'],
            ['title' => 'AI Scams',            'slug' => 'ai-scams'],
            ['title' => 'Bank Fraud',          'slug' => 'bank-fraud'],
        ],
    ],

    'impersonation-scams' => [
        'name' => 'Impersonation Scams',
        'description' => 'Recovery from "safe account", HMRC, police, and bank impersonation fraud.',
        'icon' => 'user-x',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Impersonation scams — where criminals pose as your bank, the police, HMRC, or a solicitor — are the largest single category of authorised push payment fraud. Almost every victim is entitled to reimbursement under the new PSR rules.',
        'stats' => [
            ['value' => '£239m', 'label' => 'Lost to impersonation fraud in the UK in 2023'],
            ['value' => 'Up to £85k', 'label' => 'Mandatory reimbursement per PSR claim'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A call, text, or email from "your bank" about suspicious activity',
            'Instructions to move money to a "safe account" in your own name',
            'A spoofed caller-ID matching a real bank or government number',
            'Pressure to act immediately and not discuss with anyone',
            'A follow-up message instructing you to ignore Confirmation of Payee warnings',
            'A claim that the police or NCA are involved in a covert operation',
        ],
        'process' => [
            ['icon' => 'file-text',  'title' => 'Document', 'desc' => 'We preserve the call records, messages, and bank-app screenshots that build the complaint.'],
            ['icon' => 'shield-alert','title' => 'Assess',  'desc' => 'We identify the bank\'s failures around CoP, fraud-pattern detection, and customer protection.'],
            ['icon' => 'gavel',      'title' => 'Pursue',   'desc' => 'We file CRM, PSR, and FOS complaints to compel reimbursement.'],
            ['icon' => 'banknote',   'title' => 'Recover',  'desc' => 'We secure your refund and pursue any losses above the cap separately.'],
        ],
        'content' => '
            <h2>The "Safe Account" Playbook</h2>
            <p>The most damaging impersonation scam is the "safe account" attack. The criminal, posing as your bank or the police, convinces you that fraud is in progress on your account and that funds must be moved "for safety". The destination is of course controlled by the fraudster. Sophisticated variants involve spoofed caller-ID and even fake "crime reference numbers".</p>

            <h2>Why You Are Entitled To A Refund</h2>
            <p>The whole structure of impersonation fraud is to deceive victims into authorising payments. Both the CRM Code and the new PSR mandatory reimbursement rules recognise this and require banks to refund blameless victims, generally up to £85,000 per claim. Banks frequently refuse on first request — we challenge those refusals through formal complaints and FOS escalation.</p>
        ',
        'cta_question' => 'Tricked by a fake bank or police call?',
        'faqs' => [
            ['question' => 'My bank says I was negligent — are they right?', 'answer' => 'Usually not. The threshold for "gross negligence" is high, and banks routinely overstate it. We challenge these refusals successfully every week.'],
            ['question' => 'I sent money to my own account first.',          'answer' => 'This is a common feature of safe-account scams. It does not weaken your claim — the loss occurred when the funds left for the fraudster.'],
            ['question' => 'Will the police investigate?',                   'answer' => 'You should report to Action Fraud, but criminal investigation is rare. Our work is the civil recovery route, which is much more likely to return your money.'],
        ],
        'related' => [
            ['title' => 'Phishing Scams',  'slug' => 'phishing-scams'],
            ['title' => 'Spoofing Fraud',  'slug' => 'spoofing-fraud'],
            ['title' => 'Bank Fraud',      'slug' => 'bank-fraud'],
            ['title' => 'AI Scams',        'slug' => 'ai-scams'],
        ],
    ],

    'ai-scams' => [
        'name' => 'AI Scams',
        'description' => 'Recovery from AI-powered fraud, deepfake scams, and voice-cloning attacks.',
        'icon' => 'bot',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Generative AI has supercharged fraud. Deepfake video calls, cloned voices, and AI-written phishing campaigns are now used to defraud individuals and businesses out of life-changing sums.',
        'stats' => [
            ['value' => '3,000%', 'label' => 'Increase in deepfake fraud attempts since 2022'],
            ['value' => '£25m', 'label' => 'Largest single UK deepfake CFO fraud reported to date'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'An unexpected video call from an executive, family member, or partner asking for money',
            'A voice note or call asking you to act urgently and keep the request secret',
            'Investment "opportunities" promoted by celebrity deepfakes on social media',
            'Highly personalised phishing emails referencing real colleagues or recent transactions',
            'AI-generated profile photos on dating sites (look for unnatural backgrounds, jewellery, or hands)',
            'Pressure not to verify the request through any other channel',
        ],
        'process' => [
            ['icon' => 'search',         'title' => 'Investigate', 'desc' => 'We capture and preserve the digital evidence — calls, messages, and metadata — before it can be deleted.'],
            ['icon' => 'route',          'title' => 'Trace',       'desc' => 'We follow the payment trail through banks, payment processors, or blockchain to locate the recipient.'],
            ['icon' => 'shield-alert',   'title' => 'Pursue',      'desc' => 'We notify the receiving bank, file FOS and CRM Code complaints, and pursue chargebacks where applicable.'],
            ['icon' => 'banknote',       'title' => 'Recover',     'desc' => 'We negotiate or litigate against the recipient and any negligent intermediaries to return your funds.'],
        ],
        'content' => '
            <h2>How AI-Powered Scams Work</h2>
            <p>Criminals now use freely available AI tools to clone a voice from a few seconds of audio, generate a deepfake video of a colleague, or write thousands of bespoke phishing emails per hour. The aim is the same as traditional fraud — to get you to authorise a payment — but the credibility of the impersonation is now far higher than anything possible even two years ago.</p>

            <h2>The Most Common AI Scam Types</h2>
            <ul>
                <li><strong>Deepfake video conferencing fraud</strong> — fake "CEO" or "CFO" on a Zoom call instructing an urgent wire transfer</li>
                <li><strong>Voice-cloning "grandparent" scams</strong> — a relative supposedly in trouble and needing immediate help</li>
                <li><strong>AI-generated investment fraud</strong> — celebrity deepfakes promoting fake trading platforms</li>
                <li><strong>Hyper-personalised phishing</strong> — emails that reference real names, projects, and dates</li>
                <li><strong>Synthetic-identity romance fraud</strong> — entirely AI-generated personas on dating apps</li>
            </ul>

            <h2>Your Legal Position</h2>
            <p>Even though the technology is new, the legal routes for recovery are well-established. Authorised push payment (APP) victims of impersonation scams can claim under the Contingent Reimbursement Model (CRM) Code and, since October 2024, under the mandatory PSR reimbursement scheme. Card payments may qualify for chargeback or Section 75 protection. Where the receiving bank failed to apply Confirmation of Payee or to act on red-flag transactions, they may be liable for negligence.</p>

            <h2>How We Can Help</h2>
            <p>We start by preserving evidence — call recordings, video files, message threads, and metadata that fraudsters often try to delete or take offline. We then file the formal complaints, escalate to the Financial Ombudsman Service if necessary, and trace the funds through banking or blockchain channels. Where intermediaries failed in their duty of care, we pursue them directly.</p>
        ',
        'cta_question' => 'Targeted by an AI-powered scam?',
        'faqs' => [
            ['question' => 'I authorised the payment myself — can I still claim?', 'answer' => 'Yes. Under the CRM Code and the new PSR reimbursement rules, banks must reimburse blameless victims of authorised push payment fraud, including impersonation and deepfake scams.'],
            ['question' => 'Do I need to prove the scammer used AI?',              'answer' => 'No. Recovery focuses on tracing the payment and on the recipient bank\'s duty of care, not on the technology used to deceive you.'],
            ['question' => 'How quickly should I act?',                            'answer' => 'Immediately. Notify your bank within hours if possible — funds can sometimes be frozen before they leave the receiving account. Then contact us for the recovery work.'],
            ['question' => 'Can deepfake evidence be preserved?',                  'answer' => 'Yes. We have technical partners who forensically capture video, audio, and metadata in a way that is admissible in proceedings.'],
            ['question' => 'What if the money was sent in cryptocurrency?',         'answer' => 'Recovery is harder but not impossible. We use blockchain forensics to trace funds to exchanges and pursue them under know-your-customer rules.'],
        ],
        'related' => [
            ['title' => 'Impersonation Scams', 'slug' => 'impersonation-scams'],
            ['title' => 'Romance Fraud',       'slug' => 'romance-fraud'],
            ['title' => 'Phishing Scams',      'slug' => 'phishing-scams'],
            ['title' => 'Spoofing Fraud',      'slug' => 'spoofing-fraud'],
        ],
    ],

    'ponzi-fraud' => [
        'name' => 'Ponzi Fraud',
        'description' => 'Recovery for Ponzi and pyramid scheme fraud victims — from MLM crypto to fake bonds.',
        'icon' => 'triangle-alert',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1554224154-22dec7ec8818?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'A Ponzi scheme uses money from new investors to pay returns to earlier ones, creating an illusion of profitability until inflows dry up and the scheme collapses. Recovery is possible — but speed matters because assets disappear fast.',
        'stats' => [
            ['value' => '95%+', 'label' => 'Of victims lose everything when a Ponzi collapses'],
            ['value' => '£500m+', 'label' => 'Estimated UK losses to Ponzi schemes annually'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Consistent, smooth returns regardless of market conditions',
            'Returns paid out reliably, but capital impossible to withdraw',
            'A complex strategy you are told you don\'t need to understand',
            'Pressure to recruit family and friends',
            'No independent audit, no regulator, no clear underlying assets',
            'Operator personally guarantees returns',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'Investigate', 'desc' => 'We map the scheme structure, operators, and connected entities.'],
            ['icon' => 'route',      'title' => 'Trace',       'desc' => 'We follow the money to identify recoverable assets and downstream beneficiaries.'],
            ['icon' => 'gavel',      'title' => 'Pursue',      'desc' => 'We coordinate with administrators, file FSCS claims, and pursue civil action.'],
            ['icon' => 'banknote',   'title' => 'Recover',     'desc' => 'We secure dividends from administration plus FSCS payouts and direct recoveries.'],
        ],
        'content' => '
            <h2>Common Ponzi Variants in the UK</h2>
            <ul>
                <li><strong>Crypto MLM schemes</strong> with daily-yield promises (HyperVerse, Onecoin)</li>
                <li><strong>Mini-bond and corporate bond fraud</strong> (London Capital & Finance, Blackmore)</li>
                <li><strong>Forex and trading "funds"</strong> with fabricated track records</li>
                <li><strong>Property development schemes</strong> with fake or stalled projects</li>
                <li><strong>Affinity-based schemes</strong> targeting religious or community groups</li>
            </ul>

            <h2>How We Recover</h2>
            <p>The first task is to preserve any remaining assets and assert your claim early in any administration or insolvency. We file FSCS claims where regulated firms were involved, pursue introducers, and trace funds that have moved to identifiable beneficiaries. Where the operators have left the jurisdiction we coordinate with international counsel.</p>
        ',
        'cta_question' => 'Stuck in a Ponzi or pyramid scheme?',
        'faqs' => [
            ['question' => 'I haven\'t lost money yet — should I act?', 'answer' => 'Yes. Early action lets you exit before collapse and preserves your evidence and standing.'],
            ['question' => 'Can I recover from a scheme already in liquidation?', 'answer' => 'Often yes — you can file a claim with the administrator and pursue parallel routes through FSCS and civil action.'],
            ['question' => 'I introduced others — am I liable?', 'answer' => 'Usually no, if you were a victim acting in good faith. We can advise on your specific position.'],
        ],
        'related' => [
            ['title' => 'Investment Scams',     'slug' => 'investment-scams'],
            ['title' => 'Advanced Fee Fraud',   'slug' => 'advanced-fee-fraud'],
            ['title' => 'Affinity Fraud',       'slug' => 'affinity-fraud'],
            ['title' => 'HyperVerse Scam',      'slug' => 'hyperverse-scam'],
        ],
    ],

    'purchase-scams' => [
        'name' => 'Purchase Scams',
        'description' => 'Recovery for fake products, online marketplace fraud, and undelivered goods.',
        'icon' => 'shopping-cart',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1556742393-d75f468bfcb0?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Purchase scams are the most common type of authorised push payment fraud by volume — fake adverts on Facebook Marketplace, Instagram, and even Google Shopping result in goods that never arrive or arrive counterfeit.',
        'stats' => [
            ['value' => '78,000+', 'label' => 'Purchase-scam reports to Action Fraud per year'],
            ['value' => 'Up to £85k', 'label' => 'Mandatory PSR reimbursement per claim'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A price significantly below market rate',
            'A seller asking to move off-platform to WhatsApp or email',
            'A request to pay by bank transfer rather than card or PayPal',
            'A new social-media profile or seller with few or no reviews',
            'High pressure to pay before viewing the item',
            'Tracking numbers that never update or lead to a different address',
        ],
        'process' => [
            ['icon' => 'file-text',  'title' => 'Document', 'desc' => 'We capture the listing, communications, and payment evidence.'],
            ['icon' => 'shield-alert','title' => 'Assess',  'desc' => 'We identify the bank\'s CoP and fraud-pattern failures.'],
            ['icon' => 'gavel',      'title' => 'Pursue',   'desc' => 'We file PSR mandatory reimbursement and FOS complaints.'],
            ['icon' => 'banknote',   'title' => 'Recover',  'desc' => 'We secure refunds and pursue receiving banks for due diligence failures.'],
        ],
        'content' => '
            <h2>How Purchase Scams Work</h2>
            <p>Fraudsters list desirable items — game consoles, designer goods, vehicles, pets — at attractive prices. After payment by bank transfer, the seller disappears. Variants include sending an empty or counterfeit item, sending a worthless tracking number, or running long-running marketplace stores that take many small orders before vanishing.</p>

            <h2>Routes To Recovery</h2>
            <p>Card payments are usually recoverable through chargeback. Bank transfers are now covered by PSR mandatory reimbursement up to £85,000 per claim. Where the receiving bank failed to act on red flags, additional liability arises. We handle the full claim process for you.</p>
        ',
        'cta_question' => 'Paid for goods that never arrived?',
        'faqs' => [
            ['question' => 'I paid by bank transfer — am I covered?', 'answer' => 'Yes — PSR mandatory reimbursement covers most blameless purchase-scam victims since October 2024.'],
            ['question' => 'My loss is small — is it worth claiming?',  'answer' => 'Yes. We handle low-value claims efficiently and there is usually no fee unless we recover.'],
            ['question' => 'The seller still messages me with excuses.',  'answer' => 'Don\'t engage further. Preserve the messages and contact us — the bank claim does not depend on the seller.'],
        ],
        'related' => [
            ['title' => 'Internet & Online Scams', 'slug' => 'internet-online-scams'],
            ['title' => 'Bank Fraud',              'slug' => 'bank-fraud'],
            ['title' => 'Phishing Scams',          'slug' => 'phishing-scams'],
        ],
    ],

    'spoofing-fraud' => [
        'name' => 'Spoofing Scams & Fraud',
        'description' => 'Recovery from caller-ID, SMS, and email spoofing fraud.',
        'icon' => 'phone-off',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1611606063065-ee7946f0787a?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Spoofing makes a fraudster\'s call, text, or email appear to come from your bank, HMRC, or a trusted organisation. The phone genuinely shows the bank\'s number — making the deception extraordinarily convincing.',
        'stats' => [
            ['value' => '£170m+', 'label' => 'Lost to spoofing-enabled fraud annually in the UK'],
            ['value' => '#7726', 'label' => 'UK number to forward suspicious texts to'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A caller-ID matching your bank, HMRC, or police that asks for security details',
            'A text appearing in the same thread as genuine messages from your bank',
            'Instructions to move money or share one-time codes',
            'Pressure to act now to "prevent fraud"',
            'A request not to call back — "I\'ll call you on a secure line"',
        ],
        'process' => [
            ['icon' => 'file-text',   'title' => 'Document', 'desc' => 'We preserve call logs, message threads, and the phone-network metadata that proves spoofing.'],
            ['icon' => 'shield-alert','title' => 'Assess',   'desc' => 'We identify the bank\'s failures and the network\'s spoofing-prevention shortcomings.'],
            ['icon' => 'gavel',       'title' => 'Pursue',   'desc' => 'We file CRM, PSR, and FOS complaints, citing impersonation and inadequate controls.'],
            ['icon' => 'banknote',    'title' => 'Recover',  'desc' => 'We secure reimbursement and any losses above the statutory cap.'],
        ],
        'content' => '
            <h2>How Spoofing Works</h2>
            <p>Voice and SMS networks were designed in an era that did not anticipate caller-ID forgery. Criminals exploit this to make their messages appear from genuine sources — even slotting into existing message threads. Ofcom and the major networks are deploying STIR/SHAKEN authentication, but coverage is incomplete and victims continue to lose money daily.</p>

            <h2>Your Position For Recovery</h2>
            <p>Spoofing-driven fraud is impersonation fraud, fully covered by the CRM Code and the new PSR mandatory reimbursement scheme. Banks frequently try to refuse on "negligence" grounds, but the bar is high and the FOS overturns most of these refusals.</p>
        ',
        'cta_question' => 'Lost money to a spoofed call or text?',
        'faqs' => [
            ['question' => 'It really looked like my bank — will they believe me?', 'answer' => 'Yes. Spoofing is well-documented; the FOS routinely accepts that genuine-looking caller-ID does not amount to victim negligence.'],
            ['question' => 'I forwarded the text to 7726 — does that help?', 'answer' => 'It helps the network block future fraud but does not affect your claim. Your evidence package for the bank is what matters.'],
        ],
        'related' => [
            ['title' => 'Impersonation Scams', 'slug' => 'impersonation-scams'],
            ['title' => 'Phishing Scams',      'slug' => 'phishing-scams'],
            ['title' => 'Bank Fraud',          'slug' => 'bank-fraud'],
        ],
    ],

    'advanced-fee-fraud' => [
        'name' => 'Advanced Fee Fraud',
        'description' => 'Recovery from advance-fee fraud — fake loans, prizes, inheritances, and recovery scams.',
        'icon' => 'badge-pound-sterling',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1607863680198-23d4b2565df0?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Advance-fee fraud always works the same way: a small upfront payment unlocks something much bigger — a loan, prize, inheritance, or refund. The bigger thing never arrives, and follow-up fees keep being demanded.',
        'stats' => [
            ['value' => '£86m+',  'label' => 'Lost to advance-fee fraud in the UK in 2023'],
            ['value' => '#1', 'label' => 'Most common scam type targeting recovery-fraud victims'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'An offer of a loan with a required upfront "insurance" or "processing" fee',
            'A prize, inheritance, or refund requiring upfront tax or release fees',
            'A "recovery" firm contacting you after a previous scam, asking for a fee',
            'Demands paid via untraceable methods (gift cards, crypto, money-transfer agents)',
            'Each fee is followed by another that must be paid before release',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'Investigate', 'desc' => 'We identify the operating entity and any payment processors involved.'],
            ['icon' => 'route',      'title' => 'Trace',       'desc' => 'We follow the fees through banks, money-transfer agents, and crypto channels.'],
            ['icon' => 'gavel',      'title' => 'Pursue',      'desc' => 'We file PSR, FOS, and money-service-business complaints to compel reimbursement.'],
            ['icon' => 'banknote',   'title' => 'Recover',     'desc' => 'We secure refunds from regulated intermediaries and pursue identifiable recipients.'],
        ],
        'content' => '
            <h2>Recovery-Scam Warning</h2>
            <p>If you have been a victim of any earlier scam, you are now a target for "recovery" fraudsters who pose as solicitors, regulators, or government officials offering to recover your money for an upfront fee. <strong>Legitimate recovery firms do not cold-call you.</strong> Always verify any "recovery" offer by approaching the firm yourself.</p>

            <h2>How We Pursue Recovery</h2>
            <p>Even when the fraudster is overseas, the UK side of the payment trail — your bank, the money-service business, or the crypto exchange — has duties to its customer. We hold them to those duties through formal complaints and FOS escalation.</p>
        ',
        'cta_question' => 'Paid "fees" but never received what you were promised?',
        'faqs' => [
            ['question' => 'Was contacted by a "recovery" firm — should I trust them?', 'answer' => 'No. Unsolicited recovery offers are themselves a scam. We never cold-call victims.'],
            ['question' => 'I paid via crypto — anything possible?', 'answer' => 'Yes — on-chain tracing combined with exchange engagement often produces results.'],
        ],
        'related' => [
            ['title' => 'Ponzi Fraud',         'slug' => 'ponzi-fraud'],
            ['title' => 'Phishing Scams',      'slug' => 'phishing-scams'],
            ['title' => 'Romance Fraud',       'slug' => 'romance-fraud'],
        ],
    ],

    'affinity-fraud' => [
        'name' => 'Affinity Fraud',
        'description' => 'Recovery from fraud targeting religious, ethnic, professional, or community groups.',
        'icon' => 'users',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Affinity fraud exploits the trust within close-knit communities — churches, ethnic groups, professional associations, even pensioner clubs. The fraudster is often a member, or someone who has won their endorsement.',
        'stats' => [
            ['value' => '£millions', 'label' => 'Per scheme typically lost when affinity fraud collapses'],
            ['value' => '5–10 yrs', 'label' => 'Typical lifespan before discovery'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A scheme promoted within a community by a respected member',
            'Endorsement by a leader who has personally invested',
            'Pressure that questioning the scheme is disloyal or unfaithful',
            'A complex investment that members are told they don\'t need to understand',
            'Reluctance or refusal to allow community-wide audit',
        ],
        'process' => [
            ['icon' => 'users',      'title' => 'Coordinate', 'desc' => 'We coordinate group claims efficiently across multiple affected community members.'],
            ['icon' => 'search',     'title' => 'Investigate','desc' => 'We map the scheme and identify all recoverable assets and parties.'],
            ['icon' => 'gavel',      'title' => 'Pursue',     'desc' => 'We pursue the operator, regulated intermediaries, and FSCS where applicable.'],
            ['icon' => 'banknote',   'title' => 'Recover',    'desc' => 'We distribute recoveries fairly across the affected community.'],
        ],
        'content' => '
            <h2>Why Affinity Fraud Is So Damaging</h2>
            <p>Beyond the financial loss, affinity fraud breaks the community trust that allowed it to thrive. Many victims hesitate to report through fear of dividing the group, or because the perpetrator is a friend, relative, or community leader. Recovery requires a sensitive but firm approach.</p>

            <h2>Group Claims</h2>
            <p>Where many members of a community are affected, group claims are usually more efficient than individual ones — they share evidence-gathering costs, present a stronger case to regulators, and ensure recoveries are distributed fairly.</p>
        ',
        'cta_question' => 'Has your community been hit by a fraudster?',
        'faqs' => [
            ['question' => 'I don\'t want to report a fellow community member.', 'answer' => 'We understand. We can pursue civil recovery without criminal proceedings, and we coordinate discreetly.'],
            ['question' => 'Can our whole group claim together?',                'answer' => 'Yes — we routinely handle multi-victim claims and coordinate across affected members.'],
        ],
        'related' => [
            ['title' => 'Ponzi Fraud',          'slug' => 'ponzi-fraud'],
            ['title' => 'Investment Scams',     'slug' => 'investment-scams'],
            ['title' => 'Boiler Room Fraud',    'slug' => 'boiler-room-fraud'],
        ],
    ],

    'internet-online-scams' => [
        'name' => 'Internet & Online Scams',
        'description' => 'Comprehensive recovery for fake websites, social-media fraud, and other internet-based scams.',
        'icon' => 'globe',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'If your loss does not fit neatly into a single named scam type, this is the route in. Our team handles every form of online fraud — fake websites, social-media impersonation, malware-driven theft, account takeovers, and more.',
        'stats' => [
            ['value' => '£1.2bn', 'label' => 'Total UK fraud losses in 2023'],
            ['value' => '70%+',   'label' => 'Of all fraud is now cyber-enabled'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'A website with no UK contact details, address, or company registration',
            'A social-media account or business with very few or fake reviews',
            'Payment instructions outside platform protections',
            'Unusual urgency or limited-time pressure',
            'Communications full of small grammar or branding errors',
        ],
        'process' => [
            ['icon' => 'file-text',   'title' => 'Document', 'desc' => 'We preserve the website, communications, and payment evidence quickly — fraud sites disappear fast.'],
            ['icon' => 'route',       'title' => 'Trace',    'desc' => 'We follow the funds through banks, payment processors, or crypto channels.'],
            ['icon' => 'gavel',       'title' => 'Pursue',   'desc' => 'We file all relevant complaints and chargebacks and pursue intermediaries.'],
            ['icon' => 'banknote',    'title' => 'Recover',  'desc' => 'We secure refunds and pursue any further losses through identifiable parties.'],
        ],
        'content' => '
            <h2>Not Sure Which Type Of Scam Affected You?</h2>
            <p>Online fraud constantly evolves and many real cases combine multiple techniques — phishing leads to account takeover, which leads to impersonation, which leads to authorised push payments. We don\'t need you to categorise the fraud. Tell us what happened in plain words and we will identify the recovery routes.</p>

            <h2>Free Initial Assessment</h2>
            <p>The first consultation is free and confidential. We will tell you honestly whether you have a viable claim, what recovery routes exist, and what the likely outcome looks like — before any costs are incurred.</p>
        ',
        'cta_question' => 'Affected by an online scam not listed elsewhere?',
        'faqs' => [
            ['question' => 'I\'m not sure what type of scam this was.', 'answer' => 'That\'s fine. Tell us what happened and we\'ll identify the categorisation and recovery routes ourselves.'],
            ['question' => 'The website has disappeared.',              'answer' => 'Common with fraud sites, but we can usually recover archived versions and the payment trail still exists.'],
        ],
        'related' => [
            ['title' => 'Phishing Scams',  'slug' => 'phishing-scams'],
            ['title' => 'Purchase Scams',  'slug' => 'purchase-scams'],
            ['title' => 'Bank Fraud',      'slug' => 'bank-fraud'],
        ],
    ],

    'hyperverse-scam' => [
        'name' => 'HyperVerse Scam',
        'description' => 'Specialist recovery for HyperVerse, HyperFund, and HyperNation crypto-MLM victims.',
        'icon' => 'orbit',
        'category' => 'online',
        'hero_image' => 'https://images.unsplash.com/photo-1620336655055-088d06e36bf0?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'HyperVerse — also marketed as HyperFund, HyperNation, and HyperOne — was a multi-billion-dollar global Ponzi scheme that collapsed leaving thousands of UK investors unable to withdraw. We specialise in recovery for affected investors.',
        'stats' => [
            ['value' => '$1.9bn+', 'label' => 'Estimated global losses to the HyperVerse scheme'],
            ['value' => '70+',     'label' => 'Countries with affected investors'],
            ['value' => '4.8 ★',   'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'You were promised 0.5–1% daily returns indefinitely',
            'You were encouraged to recruit downline members',
            'Withdrawals stopped working and were replaced with new "products"',
            'You were rolled into HyperNation, HyperOne, or follow-up rebrands',
            'You paid using cryptocurrency through Tether (USDT)',
        ],
        'process' => [
            ['icon' => 'search',     'title' => 'On-chain Trace', 'desc' => 'We map your USDT deposits through HyperVerse wallets to current resting points.'],
            ['icon' => 'building-2', 'title' => 'Exchange Action','desc' => 'We engage exchanges holding traceable proceeds with formal disclosure and freeze requests.'],
            ['icon' => 'gavel',      'title' => 'Pursue',         'desc' => 'We coordinate with international class actions and pursue identifiable promoters.'],
            ['icon' => 'banknote',   'title' => 'Recover',        'desc' => 'We secure recoveries from frozen exchange balances and judgments against named parties.'],
        ],
        'content' => '
            <h2>The HyperVerse Story</h2>
            <p>HyperFund launched in 2020 promising daily returns of around 0.5–1% on Tether (USDT) deposits, with bonuses for recruiting new members. After early withdrawals built confidence, the scheme rebranded multiple times — HyperVerse, HyperNation, HyperOne — each rebrand requiring fresh deposits and locking up the previous balance. By 2022, withdrawals had effectively stopped for most investors. Multiple regulators have since identified it as a Ponzi scheme, and class actions are underway in the US, Australia, and the UK.</p>

            <h2>How Recovery Works</h2>
            <p>USDT transactions are fully traceable on the Tron and Ethereum blockchains. We map your specific deposit history through the HyperVerse wallets and identify where recoverable funds now sit — typically at large exchanges where the operators converted to fiat. Combined with the international class-action proceedings, this gives meaningful recovery prospects.</p>
        ',
        'cta_question' => 'Locked out of HyperVerse / HyperFund / HyperNation?',
        'faqs' => [
            ['question' => 'Is it too late to claim?',                'answer' => 'No. Tracing on the blockchain remains possible long after deposits, and class actions continue to develop.'],
            ['question' => 'Should I keep paying "upgrade" fees to unlock my balance?', 'answer' => 'Absolutely not. Those fees are a continuation of the scam.'],
            ['question' => 'I deposited through a referrer — are they liable?', 'answer' => 'In some cases yes, particularly if they were a paid promoter. We will assess this in your case.'],
        ],
        'related' => [
            ['title' => 'Cryptocurrency Recovery', 'slug' => 'cryptocurrency'],
            ['title' => 'Ponzi Fraud',             'slug' => 'ponzi-fraud'],
            ['title' => 'Investment Scams',        'slug' => 'investment-scams'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Bank & Recovery
    |--------------------------------------------------------------------------
    */

    'bank-fraud' => [
        'name' => 'Bank Fraud',
        'description' => 'Expert recovery for bank fraud and authorised push payment scams.',
        'icon' => 'building-2',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1601597111158-2fceff292cdc?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Authorised push payment (APP) fraud is now the largest single category of payment fraud in the UK. New PSR rules mean most victims are entitled to mandatory reimbursement — but banks frequently refuse on the first attempt.',
        'stats' => [
            ['value' => '£459m', 'label' => 'Lost to APP fraud in the UK in 2023 (UK Finance)'],
            ['value' => 'Up to £85k', 'label' => 'Mandatory PSR reimbursement per claim'],
            ['value' => '4.8 ★', 'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'You were tricked into authorising a payment to an account you believed was legitimate',
            'Your bank refused or delayed reimbursement and cited "negligence"',
            'You were told to ignore Confirmation of Payee warnings',
            'You were rushed by a "fraud officer," HMRC official, or solicitor on the phone',
            'The scam involved an investment, a property purchase, an invoice, or a romantic relationship',
            'Your bank failed to flag a transaction that was unusual for your account',
        ],
        'process' => [
            ['icon' => 'file-text',     'title' => 'Document',  'desc' => 'We capture every detail — timing, communications, and your bank\'s actions — to build a watertight complaint.'],
            ['icon' => 'mail',          'title' => 'Complain',  'desc' => 'We submit a formal complaint to your bank citing the CRM Code, the PSR reimbursement rules, and any failures in their duty of care.'],
            ['icon' => 'gavel',         'title' => 'Escalate',  'desc' => 'If the bank refuses or delays, we escalate to the Financial Ombudsman Service and, where appropriate, the courts.'],
            ['icon' => 'banknote',      'title' => 'Recover',   'desc' => 'We secure reimbursement and pursue the receiving bank for any shortfall.'],
        ],
        'content' => '
            <h2>What Counts as Bank Fraud?</h2>
            <p>"Bank fraud" covers a range of scams that involve the misuse of banking systems. The most common today is <strong>authorised push payment (APP) fraud</strong>: you are deceived into authorising a payment to an account controlled by a fraudster. Because you "authorised" it, banks have historically refused refunds — but the law has changed significantly.</p>

            <h2>Your Rights Under the New Rules</h2>
            <p>Since October 2024, the Payment Systems Regulator (PSR) requires UK banks to reimburse most victims of APP fraud up to £85,000 within five business days, regardless of which bank you used. This applies to faster payments and CHAPS within the UK.</p>
            <p>The earlier <strong>Contingent Reimbursement Model (CRM) Code</strong> still applies to signatory banks for older claims. Both regimes require you to have acted reasonably — but the bar is lower than many banks initially claim.</p>

            <h2>Why Banks Refuse — And How We Overturn It</h2>
            <p>Banks routinely cite "gross negligence" or "you should have known" to refuse a refund. We challenge these refusals by:</p>
            <ul>
                <li>Demonstrating the sophistication of the scam and any vulnerability factors</li>
                <li>Showing the bank failed Confirmation of Payee or ignored unusual-transaction warnings</li>
                <li>Pursuing the receiving bank for failure to apply know-your-customer checks</li>
                <li>Escalating to the Financial Ombudsman Service, who upholds a high proportion of APP claims</li>
            </ul>

            <h2>Other Types of Bank Fraud We Recover</h2>
            <p>We also help with card fraud, identity-theft loans, account takeover fraud, business invoice and CEO fraud, mandate fraud, and unauthorised debits. Each has its own legal route, and our team selects the strongest combination for your circumstances.</p>
        ',
        'cta_question' => 'Has your bank refused to refund you?',
        'faqs' => [
            ['question' => 'Will my bank refund me?',                                'answer' => 'Most blameless APP fraud victims are now entitled to mandatory reimbursement up to £85,000 under the PSR rules. If your bank has refused, we can challenge that refusal.'],
            ['question' => 'How long do I have to make a claim?',                    'answer' => 'You should report the fraud to your bank as soon as possible. Formal complaints generally need to be brought within six years, with a six-month window after the bank\'s final response to escalate to the Ombudsman.'],
            ['question' => 'What if I sent the money myself — am I to blame?',       'answer' => 'No. The whole point of APP fraud is that victims authorise the payment. The legal protections exist precisely because of that.'],
            ['question' => 'My loss was over £85,000 — am I out of luck?',           'answer' => 'No. The £85,000 cap is on mandatory reimbursement; we can pursue the excess through complaints against the receiving bank, civil claims, and other routes.'],
            ['question' => 'Will the Ombudsman find in my favour?',                  'answer' => 'The FOS upholds a majority of APP fraud complaints when properly presented. Strong evidence and the right legal arguments make a substantial difference.'],
            ['question' => 'Do you charge if my claim is unsuccessful?',             'answer' => 'Many bank-fraud cases are taken on a no-win-no-fee basis. We will agree all fees in writing before starting work.'],
        ],
        'related' => [
            ['title' => 'Revolut Scam Refunds', 'slug' => 'revolut-scam-refunds'],
            ['title' => 'Monzo Fraud',          'slug' => 'monzo-fraud'],
            ['title' => 'Chase Bank Scams',     'slug' => 'chase-bank-scams'],
            ['title' => 'Tracing Services',     'slug' => 'tracing-services'],
        ],
    ],

    'revolut-scam-refunds' => [
        'name' => 'Revolut Scam Refunds',
        'description' => 'Specialist recovery for scams involving Revolut accounts — sending or receiving.',
        'icon' => 'credit-card',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Revolut is the most-cited bank in UK fraud complaints. Whether you sent money from a Revolut account to a scam, or your account was used to receive funds from one, we can help you recover.',
        'stats' => [
            ['value' => '#1',         'label' => 'Most-complained-about firm to the FOS for fraud cases'],
            ['value' => 'Up to £85k', 'label' => 'Mandatory PSR reimbursement per claim'],
            ['value' => '4.8 ★',     'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Revolut refused your fraud claim citing "negligence"',
            'No or weak Confirmation of Payee warning shown before transfer',
            'In-app fraud warnings missed obvious red flags on a known scam merchant',
            'Account frozen unexpectedly after a fraudster paid in funds',
            'Customer service responses limited to in-app chat with long delays',
        ],
        'process' => [
            ['icon' => 'file-text',    'title' => 'Document', 'desc' => 'We collate the chat transcripts, transaction records, and Revolut\'s decision letters.'],
            ['icon' => 'shield-alert', 'title' => 'Assess',   'desc' => 'We identify Revolut\'s breaches of the CRM Code, PSR rules, and FCA guidance.'],
            ['icon' => 'gavel',        'title' => 'Pursue',   'desc' => 'We file the formal complaint and escalate to the FOS, which routinely upholds Revolut cases.'],
            ['icon' => 'banknote',     'title' => 'Recover',  'desc' => 'We secure reimbursement plus interest and distress compensation where applicable.'],
        ],
        'content' => '
            <h2>Why Revolut Cases Are So Common</h2>
            <p>Revolut\'s rapid growth, app-only customer service, and historic gaps in Confirmation of Payee coverage have made it the most-complained-about UK financial firm for fraud cases. The FOS upholds a high proportion of complaints against Revolut, often where the bank initially refused.</p>

            <h2>Outgoing Fraud (You Sent Funds)</h2>
            <p>Most claims involve impersonation, investment, or purchase scams where you sent funds from your Revolut account. Under the new PSR rules these are now subject to mandatory reimbursement up to £85,000 per claim, and we challenge any refusal through the FOS.</p>

            <h2>Incoming Fraud (Your Account Received Funds)</h2>
            <p>If your account was used unwittingly to receive scam funds and Revolut has frozen your balance, we can help unfreeze the legitimate funds while protecting your position.</p>
        ',
        'cta_question' => 'Has Revolut refused your fraud claim?',
        'faqs' => [
            ['question' => 'Revolut said I was "grossly negligent".', 'answer' => 'A common refusal that the FOS frequently overturns. We challenge it routinely.'],
            ['question' => 'How long does a Revolut FOS case take?',   'answer' => 'Typically 3–9 months from filing.'],
            ['question' => 'My account is still frozen.',              'answer' => 'We negotiate with Revolut\'s legal team to release legitimate funds while resolving any concerns.'],
        ],
        'related' => [
            ['title' => 'Bank Fraud',          'slug' => 'bank-fraud'],
            ['title' => 'Monzo Fraud',         'slug' => 'monzo-fraud'],
            ['title' => 'Chase Bank Scams',    'slug' => 'chase-bank-scams'],
            ['title' => 'Impersonation Scams', 'slug' => 'impersonation-scams'],
        ],
    ],

    'monzo-fraud' => [
        'name' => 'Monzo Fraud',
        'description' => 'Recovery for fraud involving Monzo accounts — PSR reimbursement and FOS escalation.',
        'icon' => 'smartphone',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Monzo accounts are heavily targeted by fraudsters as both sending and receiving accounts. We help victims navigate Monzo\'s in-app complaints process and escalate effectively to the FOS.',
        'stats' => [
            ['value' => 'Up to £85k', 'label' => 'Mandatory PSR reimbursement per claim'],
            ['value' => '5 days',     'label' => 'Maximum response time for PSR refunds'],
            ['value' => '4.8 ★',     'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Monzo declined your fraud claim citing "reasonable basis"',
            'In-app fraud warning missed an obvious scam pattern',
            'Funds left for a fraudster\'s named account without proper CoP check',
            'Account closure following a fraud report, with funds withheld',
        ],
        'process' => [
            ['icon' => 'file-text',    'title' => 'Document', 'desc' => 'We compile the chat history, payment screen captures, and Monzo\'s decisions.'],
            ['icon' => 'shield-alert', 'title' => 'Assess',   'desc' => 'We identify Monzo\'s CRM, PSR, and CoP failures.'],
            ['icon' => 'gavel',        'title' => 'Pursue',   'desc' => 'We file the formal complaint and escalate to the FOS where needed.'],
            ['icon' => 'banknote',     'title' => 'Recover',  'desc' => 'We secure reimbursement plus statutory interest.'],
        ],
        'content' => '
            <h2>How Monzo Fraud Cases Work</h2>
            <p>Monzo, like other digital banks, processes payments quickly and frequently sees scam funds pass through its accounts within minutes. Both inbound and outbound fraud generate complaints. We have substantial experience navigating Monzo\'s claims process and securing reimbursement, often via FOS escalation when Monzo initially refuses.</p>

            <h2>What We Need From You</h2>
            <p>Screenshots of all in-app communication, transaction details, and any decision letter from Monzo. We handle the rest, including the formal complaint and FOS submission.</p>
        ',
        'cta_question' => 'Lost money via a Monzo account?',
        'faqs' => [
            ['question' => 'Monzo refused on "reasonable basis".', 'answer' => 'A common refusal that the FOS often overturns where Monzo failed to apply CoP or fraud-pattern analysis properly.'],
            ['question' => 'My Monzo account was closed.',         'answer' => 'Account closure does not affect your right to a refund of the fraud loss.'],
        ],
        'related' => [
            ['title' => 'Bank Fraud',           'slug' => 'bank-fraud'],
            ['title' => 'Revolut Scam Refunds', 'slug' => 'revolut-scam-refunds'],
            ['title' => 'Chase Bank Scams',     'slug' => 'chase-bank-scams'],
        ],
    ],

    'chase-bank-scams' => [
        'name' => 'Chase Bank Scams',
        'description' => 'Recovery for scams involving Chase UK accounts — a frequent destination for scam funds.',
        'icon' => 'building',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1601597111158-2fceff292cdc?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Chase UK\'s rapid growth has made it a frequent destination account for scam funds. Whether you sent money to a Chase account or your own Chase account was used in a fraud, we can help.',
        'stats' => [
            ['value' => 'Up to £85k', 'label' => 'Mandatory PSR reimbursement per claim'],
            ['value' => 'JPMC',       'label' => 'Backed by JPMorgan Chase — a regulated UK bank'],
            ['value' => '4.8 ★',     'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Funds you sent to a Chase account that turned out to be fraud',
            'Chase refused your fraud claim or delayed beyond the PSR deadline',
            'Your Chase account was frozen after receiving scam funds',
            'You were directed to move funds to a Chase "safe account"',
        ],
        'process' => [
            ['icon' => 'file-text',    'title' => 'Document', 'desc' => 'We compile your transaction history, in-app communications, and Chase decisions.'],
            ['icon' => 'shield-alert', 'title' => 'Assess',   'desc' => 'We identify Chase\'s CRM, PSR, and KYC failures — including those of the receiving Chase account.'],
            ['icon' => 'gavel',        'title' => 'Pursue',   'desc' => 'We file complaints, escalate to the FOS, and engage Chase\'s receiving-bank obligations.'],
            ['icon' => 'banknote',     'title' => 'Recover',  'desc' => 'We secure reimbursement plus pursuit of the receiving Chase account holder where applicable.'],
        ],
        'content' => '
            <h2>Sending Bank vs Receiving Bank</h2>
            <p>If you sent funds from another bank to a Chase account that turned out to be fraudulent, your sending bank handles the PSR claim — but Chase, as the receiving bank, has duties to apply KYC and may share liability. We pursue both routes in parallel.</p>

            <h2>Chase as Sending Bank</h2>
            <p>If you authorised a payment from your Chase account that turned out to be a scam, Chase is responsible for PSR reimbursement up to £85,000. Refusals are challenged through the FOS.</p>
        ',
        'cta_question' => 'Sent or received money via a Chase account that turned out to be fraud?',
        'faqs' => [
            ['question' => 'How quickly should Chase respond?', 'answer' => 'Under PSR rules, eligible claims should be reimbursed within 5 business days.'],
            ['question' => 'Chase has frozen my account.',      'answer' => 'We help unfreeze legitimate funds while protecting your overall position.'],
        ],
        'related' => [
            ['title' => 'Bank Fraud',           'slug' => 'bank-fraud'],
            ['title' => 'Revolut Scam Refunds', 'slug' => 'revolut-scam-refunds'],
            ['title' => 'Monzo Fraud',          'slug' => 'monzo-fraud'],
        ],
    ],

    'regulated-broker-recovery' => [
        'name' => 'Regulated Broker Recovery',
        'description' => 'Recovering losses from regulated brokerage disputes — mis-selling, churning, and unauthorised trading.',
        'icon' => 'shield-check',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Even FCA-regulated brokers can fail their clients — through mis-selling unsuitable products, churning portfolios for commission, executing orders poorly, or trading without authority. Where this happens you have strong rights through the FOS and FSCS.',
        'stats' => [
            ['value' => 'Up to £430k', 'label' => 'FOS award limit per investment claim'],
            ['value' => 'Up to £85k',  'label' => 'FSCS protection if the firm has failed'],
            ['value' => '4.8 ★',      'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'Investments recommended that did not match your risk profile',
            'Excessive trading on your account that generated commissions but eroded value',
            'Trades you did not authorise',
            'Failure to execute your instructions or to follow stop-losses',
            'Concentrated positions in single high-risk assets without adequate disclosure',
            'Failure to provide promised reports or statements',
        ],
        'process' => [
            ['icon' => 'file-search',  'title' => 'Review',  'desc' => 'We obtain account history, suitability assessments, and KYC documentation.'],
            ['icon' => 'shield-alert', 'title' => 'Assess',  'desc' => 'We identify breaches of the FCA Conduct of Business Sourcebook and your client agreement.'],
            ['icon' => 'gavel',        'title' => 'Claim',   'desc' => 'We file the formal complaint, escalate to the FOS, and prepare FSCS claims if the firm has failed.'],
            ['icon' => 'banknote',     'title' => 'Recover', 'desc' => 'We secure compensation up to FOS/FSCS limits or pursue civil action above them.'],
        ],
        'content' => '
            <h2>Common Regulated-Broker Failings</h2>
            <ul>
                <li><strong>Suitability failures</strong> — recommending products beyond your risk capacity or knowledge</li>
                <li><strong>Churning</strong> — excessive trading to generate commissions</li>
                <li><strong>Unauthorised trading</strong> — transactions you never approved</li>
                <li><strong>Best-execution failures</strong> — orders filled on poor terms</li>
                <li><strong>Concentration risk</strong> — over-exposure to single assets without disclosure</li>
                <li><strong>Reporting failures</strong> — missing or misleading statements</li>
            </ul>

            <h2>Compensation Routes</h2>
            <p>The FOS can award up to £430,000 per investment complaint. Where the firm has failed, the FSCS pays up to £85,000. For larger losses, civil action against the firm and individual advisers remains available.</p>
        ',
        'cta_question' => 'Failed by a regulated broker or financial adviser?',
        'faqs' => [
            ['question' => 'How far back can I claim?',                  'answer' => 'Generally six years from the loss, or three years from when you reasonably knew of it. Some claims have longer windows.'],
            ['question' => 'My adviser said the loss was "market risk".', 'answer' => 'Market risk is no defence to suitability or execution failures. We separate honest losses from compensable ones.'],
        ],
        'related' => [
            ['title' => 'Trading Scams',     'slug' => 'trading-scams'],
            ['title' => 'Investment Scams',  'slug' => 'investment-scams'],
            ['title' => 'Pension Scams',     'slug' => 'pension-scams'],
        ],
    ],

    'tracing-services' => [
        'name' => 'Tracing Services',
        'description' => 'Professional asset tracing across banks, blockchains, and corporate structures.',
        'icon' => 'search',
        'category' => 'bank',
        'hero_image' => 'https://images.unsplash.com/photo-1551836022-deb4988cc6c0?auto=format&fit=crop&w=1920&q=80',
        'intro' => 'Recovery often starts with finding the money. Our tracing team uses banking subpoenas, blockchain forensics, corporate-records investigation, and OSINT to locate hidden assets and identify recipients of stolen funds.',
        'stats' => [
            ['value' => '70%+',                'label' => 'Of fraudulent crypto eventually flows through a regulated exchange'],
            ['value' => 'Multi-jurisdiction',  'label' => 'Tracing across the UK, EU, US, and major offshore centres'],
            ['value' => '4.8 ★',              'label' => 'Trustpilot rating'],
        ],
        'warning_signs' => [
            'You have a judgment but the defendant claims to have no assets',
            'Funds were sent abroad through layered corporate structures',
            'Cryptocurrency was used to obscure the trail',
            'A spouse or business partner has dissipated marital or company assets',
            'A debtor has gone silent or moved jurisdiction',
        ],
        'process' => [
            ['icon' => 'search',   'title' => 'Scope',   'desc' => 'We assess what is known, what is needed, and what tracing tools are appropriate.'],
            ['icon' => 'route',    'title' => 'Trace',   'desc' => 'We use banking disclosure, blockchain forensics, OSINT, and corporate-records investigation.'],
            ['icon' => 'gavel',    'title' => 'Secure',  'desc' => 'Where assets are found, we obtain freezing orders to prevent dissipation.'],
            ['icon' => 'banknote', 'title' => 'Enforce', 'desc' => 'We coordinate enforcement against identified assets through UK and international processes.'],
        ],
        'content' => '
            <h2>Tracing Tools We Use</h2>
            <ul>
                <li><strong>Banking disclosure orders</strong> — Bankers Trust and Norwich Pharmacal applications</li>
                <li><strong>Blockchain forensics</strong> — mapping crypto flows across wallets, mixers, and exchanges</li>
                <li><strong>Corporate-records investigation</strong> — unpicking shell-company structures across jurisdictions</li>
                <li><strong>OSINT</strong> — leveraging public records, social media, and leaked databases</li>
                <li><strong>International liaison</strong> — working with foreign counsel for cross-border enforcement</li>
            </ul>

            <h2>When To Use Tracing</h2>
            <p>Tracing is most valuable when you already know the loss but not where the money has gone, or when a defendant claims to have no recoverable assets. It is equally valuable for civil fraud claims, divorce cases, business disputes, and judgment enforcement.</p>
        ',
        'cta_question' => 'Need to find where money has gone?',
        'faqs' => [
            ['question' => 'How long does a trace take?',          'answer' => 'Initial tracing reports often take 4–8 weeks. Court-ordered disclosure adds further time.'],
            ['question' => 'Is the result usable in court?',       'answer' => 'Yes — our reports are prepared to evidential standards for use in proceedings.'],
            ['question' => 'Can you trace internationally?',       'answer' => 'Yes, particularly across the UK, EU, US, and major offshore financial centres.'],
        ],
        'related' => [
            ['title' => 'Cryptocurrency Recovery', 'slug' => 'cryptocurrency'],
            ['title' => 'Bank Fraud',              'slug' => 'bank-fraud'],
            ['title' => 'Investment Scams',        'slug' => 'investment-scams'],
        ],
    ],

];
