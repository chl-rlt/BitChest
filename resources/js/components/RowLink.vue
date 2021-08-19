<template>
    <td class="w-full lg:w-auto text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        <Link :href="href" class="p-3 block">
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
    props: ['href'],
}
</script>
