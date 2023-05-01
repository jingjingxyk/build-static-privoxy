#!/usr/bin/env bash

set -exu
__DIR__=$(
  cd "$(dirname "$0")"
  pwd
)
__PROJECT__=$(
  cd ${__DIR__}/../../../
  pwd
)
cd ${__PROJECT__}
cd ${__PROJECT__}/php-src


make -j $(nproc) cli


cd ${__PROJECT__}
mkdir -p bin/.libs

export CPPFLAGS="-I/usr/include"
export LDFLAGS="-L/usr/lib -all-static"
export EXTRA_LDFLAGS_PROGRAM="-all-static  -L/usr/lib"

make -j $(nproc) cli

${__PROJECT__}/php-src/sapi/cli/php.exe -v

cp -f ${__PROJECT__}/php-src/sapi/cli/php.exe  ${__PROJECT__}/bin/
cp -f ${__PROJECT__}/php-src/sapi/cli/php.exe  ${__PROJECT__}/bin/php-cli.exe
${__PROJECT__}/bin/php-cli.exe -v
