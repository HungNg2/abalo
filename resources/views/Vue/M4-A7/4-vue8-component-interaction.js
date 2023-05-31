export default {
    methods: {

        afunktion: function(count) {
            return count + 2;
        }
    },
    data: function() {
        return {
            count: 0
        };
    },
    template: `
        <div>
            <button @click="bfunktion">+</button>
            <p>{{ count }}</p>
        </div>
    `
};
