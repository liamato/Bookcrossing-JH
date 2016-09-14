@servers(['web' => env().'@127.0.0.1'])

@setup
    $path = base_path();
@endsetup

@task('upgrade', ['on' => 'web'])

    cd {{ $path }}
    git pull

@endtask
