<template>
    <h1>Show User</h1>
    <div>
        <img class="img-responsive img-rounded" :src="userShown.profile_photo_url" alt="User picture">
        <ul>
            <li>{{ userShown.name }}</li>
            <li>{{ userShown.email }}</li>
            <li>{{ role.name }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        userShown: {
            type: Object,
            required: true,
        },
        role: {
            type: Object,
            required: true,
        },
    },
}
</script>
