<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer\Customer;

class ImportCustomerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customer data';

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
            $customers = [];
            foreach($records as $record)
            {
                if(isset($record[0]))
                {
                    $customers[] = [
                        'id'            => $record[0],
                        'name'          => $record[3],
                        'designation'   => $record[1],
                        'email'         => $record[2],
                        'phone_number'  => $record[5],
                        'registered_at' => date('Y-m-d', strtotime($record[4])),
                    ];
                    $count++;
                }
            }

            if($customers)
            {
                try {
                    Customer::insert($customers);
                    $output->writeln("Total " . $count . ' customers imported');
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
