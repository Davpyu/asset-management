<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin';

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
     * @return int
     */
    public function handle()
    {
        $data = $this->validate($this->data());
        $data['role'] = 'admin';
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        $this->info('Admin created');
        return 0;
    }

    public function data()
    {
        $name = $this->ask('Nama');
        $username = $this->ask('Username');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $password_confirmation = $this->secret('Password Confirmation');
        $phone = $this->ask('Nomor HP');
        $address = $this->ask('Alamat');
        return [
            'name'                      => $name,
            'username'                  => $username,
            'email'                     => $email,
            'password'                  => $password,
            'password_confirmation'     => $password_confirmation,
            'phone_number'              => $phone,
            'address'                   => $address
        ];
    }

    public function validate(array $array)
    {
        $validator = Validator::make($array, $this->rules());
        if ($validator->fails()) {
            $this->error($validator->errors()->first());
        }
        $this->info('Validation Success');
        return $array;
    }

    public function rules()
    {
        return [
            'name'          => ['required', 'string', 'regex:/^[A-Za-z ]+$/'],
            'username'      => ['required', 'string', 'unique:users,username'],
            'password'      => ['required', 'string', 'confirmed'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'phone_number'  => [
                'required',
                'string',
                'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/'
            ],
            'address'        => ['required', 'string']
        ];
    }
}
