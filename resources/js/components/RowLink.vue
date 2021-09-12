<template>
    <td :class="className">
        <Link :href="href" class="sm:p-3 sm:flex sm:items-center sm:w-full">
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
