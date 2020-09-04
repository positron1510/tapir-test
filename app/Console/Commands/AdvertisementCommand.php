<?php

namespace App\Console\Commands;

use App\Models\Advertisement;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdvertisementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertisement:get {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение списка объявлений или конкретного объявления по идентификатору';

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
     * @param Advertisement $advertisement
     *
     * @return void
     *
     * Метод обработчик
     */
    public function handle(Advertisement $advertisement):void
    {
        $arguments = $this->arguments();
        unset($arguments['command']);
        $arguments['id'] = (int) $arguments['id'];

        $advertisement->repository->setRequest($arguments);

        try {
            if ($arguments['id']) {
                $result = $advertisement->repository->getSingle();
            }else {
                $result = $advertisement->repository->getAll();
            }
        }catch (ModelNotFoundException $ex) {
            $result['errors'] = $ex->getMessage();
        }

        $this->info(json_encode($result, JSON_UNESCAPED_UNICODE));
    }
}
