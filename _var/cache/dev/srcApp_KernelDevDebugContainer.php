<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZZVCYUr\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZZVCYUr/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZZVCYUr.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZZVCYUr\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerZZVCYUr\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'ZZVCYUr',
    'container.build_id' => 'ab8df3b2',
    'container.build_time' => 1710332844,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZZVCYUr');
