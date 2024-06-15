@echo off

setlocal
rem show current file location
echo %~dp0
cd %~dp0
cd ..\..\..\..\..\

set __PROJECT__=%cd%
cd /d %__PROJECT__%
mkdir  build

set CMAKE_BUILD_PARALLEL_LEVEL=%NUMBER_OF_PROCESSORS%

cd thirdparty\brotli
dir
mkdir  build-dir
cd build-dir
cmake .. ^
-DCMAKE_INSTALL_PREFIX="%__PROJECT__%\build\brotli" ^
-DCMAKE_BUILD_TYPE=Release  ^
-DBUILD_SHARED_LIBS=OFF  ^
-DBUILD_STATIC_LIBS=ON  ^
-DBROTLI_DISABLE_TESTS=OFF  ^
-DBROTLI_BUNDLED_MODE=OFF

cmake --build . --config Release --target install

cd /d %__PROJECT__%
endlocal
