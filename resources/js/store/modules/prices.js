export default {

    namespaced: true,

    state: {},

    getters: {

        lastPrice: (state, getters, rootState, rootGetters) => (arr, id) => {
            return rootGetters['markets/getLastsMarkets'](arr).find(market => market.cryptocurrencie_id === id).price
        },

        differenceCurrency: (state, getters) => (arr, id, quantity, prices) => {
            return ((getters.lastPrice(arr, id) * quantity) - prices).toFixed(2)
        },

        differencePercentage: (state, getters) => (arr, id, quantity, prices) => {
            return ((((getters.lastPrice(arr, id) * quantity) - prices) / (getters.lastPrice(arr, id) * quantity)) * 100).toFixed(2)
        },

    },

    mutations: {},

    actions: {},
}
