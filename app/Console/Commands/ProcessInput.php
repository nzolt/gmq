<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geomiq:process:input {--file=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process the input string and returm JSON string';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $content = "elapsed_time=0.0022132396697998047, type-CNC,radius-1-15,position-1=0.000000000000014,position-1//90,position-2=0%direction-1=-2.0816681711721685e-16";
        if($this->option('file')){

        }
        $unified = str_replace('%', ',', $content);
        $content_array = explode(",", $unified);
        $values['data'][] = $this->parse($content_array);

        $response = json_encode(
            $values,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
        $this->table(['json'],
            [[$response]]
        );
    }

    protected function parse($values_array)
    {
        $fc = [];
        $features = [];
        foreach ($values_array as $value) {
            $arr = explode('-', trim($value));
            if (count($arr) == 1) {
                $arr = explode('=', trim($value));
            }

            preg_match_all('/-?\\d+(?:\\.\\d+)?/m', $value, $matches);

            if (count($matches[0]) == 1) {
                $fc[trim($arr[0])] = round($matches[0][0], 6);
            } elseif (count($matches[0]) > 1) {
                if(count($matches[0]) == 3) {
                    $matches[0][1] = $matches[0][1] . 'e' . $matches[0][2];
                };var_dump($value, strpos($value,'position'));
                if(strpos($value,'position') === 0){
                    $matches[0][1] = [$matches[0][1]];
                }
                $features[($matches[0][0] * -1)][trim($arr[0])] = $matches[0][1];
            } elseif (count($matches[0]) == 0) {
                $va = explode('-', $value);
                $fc[trim($va[0])] = $va[1];
            }
        }
        $fc["feature_count"] = count($features);
        foreach ($features as $id => $feature){
            $feature['id'] = $id;
            $fc["features"][] = $feature;
        }

        return $fc;
    }
}
