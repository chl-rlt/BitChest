<template>
  <span :class="className" class="p-1 rounded w-full">{{ data }} <slot></slot></span>
</template>

<script>
export default {
    props: ['data'],

    data() {
        return {
            className: null
        }
    },

    watch: {
        data: function(newValue, oldValue) {
                // console.log('Prop changed: ', newValue, ' | was: ', oldValue)
                if(newValue >= oldValue) return this.valueUpdate('up')
                return this.valueUpdate('down')
        }
    },

    methods: {
        valueUpdate(way) {
            if(way === 'up') this.className = ['bg-green-500', 'text-white']
            else this.className = ['bg-red-500', 'text-white']
            setTimeout(()=>{
                return this.className = null
            }, 800)

        }
    },

    computed: {

    },

}
</script>

<style>

</style>
