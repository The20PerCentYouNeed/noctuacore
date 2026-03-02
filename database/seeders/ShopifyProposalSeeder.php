<?php

namespace Database\Seeders;

use App\Models\Proposal;
use Illuminate\Database\Seeder;

class ShopifyProposalSeeder extends Seeder
{
    public function run(): void
    {
        $proposal = Proposal::firstOrCreate(
            ['company_name' => 'shopify'],
            ['status' => 'under_consideration']
        );

        $accessToken = $proposal->createToken('shopify-proposal-access');

        $this->command->newLine();
        $this->command->info('✅ Shopify proposal created successfully!');
        $this->command->info('   Proposal ID: '.$proposal->id);
        $this->command->info('   Company: '.$proposal->company_name);
        $this->command->newLine();
        $this->command->warn('   Personal access token (copy this - it will not be shown again):');
        $this->command->line('   '.$accessToken->plainTextToken);
        $this->command->newLine();
        $this->command->info('   Use it in the URL: /proposals/shopify?secret='.$accessToken->plainTextToken);
        $this->command->newLine();
    }
}
