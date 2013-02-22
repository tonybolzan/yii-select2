<?php

return array(
    'sourcePath'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'messagePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'messages',
    'languages' => array('pt_br'),
    'fileTypes' => array('php'),
    'overwrite' => true,
    'exclude' => array(
        'README.md',
        'LICENSE.md',
        '.gitignore',
        '/.git',
        '/assets',
        '/messages',
        '/vendors',
    ),
);
