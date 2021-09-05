export default {

    namespaced: true,

    state: {
        lasts_markets: [],
    },

    getters: {
        lastCryptoMarket(state) {
            return (id) => state.lasts_markets.find(market => market.cryptocurrencie_id === id)
        },

    },

    mutations: {

        setLastsMarkets(state, lastsMarketsValues) {
            state.lasts_markets = lastsMarketsValues
        }

    },

    actions: {
        listenToLastsMarkets({ commit }) {
            window.Echo.channel('markets_quotations')
            .listen('.new.quotations', e => {
                commit('setLastsMarkets', e.marketsValues)
            })
        },

    },

}
