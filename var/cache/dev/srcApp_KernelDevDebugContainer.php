<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerIXzqC5a\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerIXzqC5a/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerIXzqC5a.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerIXzqC5a\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerIXzqC5a\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'IXzqC5a',
    'container.build_id' => 'fb3b41b4',
    'container.build_time' => 1583945378,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerIXzqC5a');