<template>
    <td :class="className">
        <Link :href="href" class="p-3 flex items-center w-full">
            <slot />
        </Link>
    </td>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: ['href','className'],
}
</script>
