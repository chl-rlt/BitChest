<template>
  <span class="truc">{{ data }} <slot></slot></span>
</template>

<script>
export default {
    props: ['data'],

    watch: {
        data: function(newValue, oldValue) {
                console.log('Prop changed: ', newVal, ' | was: ', oldVal)
                if(newValue >= oldValue) return valueUpdate('bg-green-500 text-white')
                return valueUpdate('bg-red-500 text-white')
        }
    },

    methods: {
        valueUpdate(className) {
            setTimeout(()=>{
                document.querySelector('.truc').classList.toggle(className)
            }, 200)
            document.querySelector('.truc').classList.toggle(className)
        }
    }

}
</script>

<style>

</style>
