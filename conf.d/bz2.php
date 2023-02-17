<?php

use SwooleCli\Library;
use SwooleCli\Preprocessor;
use SwooleCli\Extension;

return function (Preprocessor $p) {
    $p->addExtension((new Extension('bz2'))->withOptions('--with-bz2=' . BZIP2_PREFIX)->depends('bzip2'));
};
