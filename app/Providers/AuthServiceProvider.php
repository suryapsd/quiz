<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Siswa;
use App\Policies\SiswaPolicy;
use App\Models\Sekolah;
use App\Policies\SekolahPolicy;
use App\Models\Instansi;
use App\Policies\InstansiPolicy;
use App\Models\PendidikanInstansi;
use App\Policies\PendidikanInstansiPolicy;
use App\Models\SoalTesAwal;
use App\Policies\SoalTesAwalPolicy;
use App\Models\SoalTesLanjutan;
use App\Policies\SoalTesLanjutanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Siswa::class => SiswaPolicy::class,
        Sekolah::class => SekolahPolicy::class,
        Instansi::class => InstansiPolicy::class,
        PendidikanInstansi::class => PendidikanInstansiPolicy::class,
        SoalTesAwal::class => SoalTesAwalPolicy::class,
        SoalTesLanjutan::class => SoalTesLanjutanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
