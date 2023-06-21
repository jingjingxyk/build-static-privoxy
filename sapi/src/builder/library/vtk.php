<?php

use SwooleCli\Library;
use SwooleCli\Preprocessor;

return function (Preprocessor $p) {
    $vtk_prefix = VTK_PREFIX;
    $workDir = $p->getWorkDir();
    $buildDir = $p->getBuildDir();
    $lib = new Library('vtk');
    $lib->withHomePage('https://www.vtk.org/')
        ->withLicense('https://gitlab.kitware.com/vtk/vtk/-/blob/v9.2.6/Copyright.txt', Library::LICENSE_BSD)
        ->withUrl('https://gitlab.kitware.com/vtk/vtk/-/archive/v9.2.6/vtk-v9.2.6.tar.gz')
        ->withManual('https://gitlab.kitware.com/vtk/vtk/-/blob/master/Documentation/dev/build.md#building-vtk')
        ->withFile('vtk-v9.2.6.tar.gz')
        ->withDownloadScript(
            'vtk',
            <<<EOF
        git clone -b v9.2.6 --depth 1 --progress --recursive  https://gitlab.kitware.com/vtk/vtk.git

EOF
        )
        ->withPrefix($vtk_prefix)
        ->withCleanBuildDirectory()
        ->withCleanPreInstallDirectory($vtk_prefix)
        ->withBuildScript(
            <<<EOF

        mkdir -p build
        cd  build

        cmake -G Ninja \
        -DCMAKE_INSTALL_PREFIX={$vtk_prefix} \
        -DCMAKE_BUILD_TYPE=Release \
        -DWITH_FFMPEG=ON \
        -DBUILD_TESTS=OFF \
        -DBUILD_EXAMPLES=OFF \
        -DBUILD_SHARED_LIBS=OFF \
        ..

        ninja
        ninja install
EOF
        )
        ->withPkgName('opencv')
        ->withDependentLibraries(
            'ffmpeg'
        )
    ;

    $p->addLibrary($lib);
};
