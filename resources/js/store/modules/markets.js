export default {

    namespaced: true,

    state: {
        lasts_markets: [],
    },

    getters: {
        lastCryptoMarket(state) {
            return (id) => state.lasts_markets.find(market => market.cryptocurrencie_id === id)
        },

        getLastsMarkets(state) {
            return (arr) => {
                // if(state.lasts_markets.length <= 0) return arr
                if(new Date(state.lasts_markets[0]?.date) > new Date(arr[0].date)) return state.lasts_markets
                return arr
            }
        }

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
