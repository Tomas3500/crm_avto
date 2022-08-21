export default {
    data() {
        return {
            clints: [],

        }
    },

    mounted() {
        this.getClint();

    },

    methods: {
        getClint() {
            axios.get("/api/clint/index").then((response) => {
                this.clints = response.data.data;
            });
        },
    }




}