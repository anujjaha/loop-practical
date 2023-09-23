<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product\Product;

class ImportProductData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import product data';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = $this->argument('filepath');
        $file = public_path() . DIRECTORY_SEPARATOR . $fileName;
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        if (!file_exists($file) || !is_readable($file))
        {
            $output->writeln("file not found or unable to read file: " . $fileName);
        }

        $records = $this->getCsvData($file);
        if($records)
        {
            $count = 0;
            $products = [];
            foreach($records as $record)
            {
                if(isset($record[0]))
                {
                    $products[] = [
                        'id'            => $record[0],
                        'name'          => $record[1],
                        'price'         => $record[2],
                    ];
                    $count++;
                }
            }

            if($products)
            {
                try {
                    Product::insert($products);
                    $output->writeln("Total " . $count . ' products imported');
                } catch(Exception $e) {
                    $output->writeln("something went wrong with error: " . $e->getMessage());
                }
            }

            $output->writeln("Completed");
        }

        return;
    }

    /**
     * Get CSV Data
     *
     * @return array
     */
    private function getCsvData(string $file): array
    {
        $header = null;
        $data   = [];

        if (($handle = fopen($file, 'r')) !== false)
        {
            $count = 0;
            while (($row = fgetcsv($handle)) !== false)
            {
                $count++;
                if ($count == 1)
                    continue;
                
                $data[] = $row;                
            }
            fclose($handle);
        }

        return $data;
    }
}
