export default {
    props: ['showImpressum'],
    emits: ['show-impressum'],
    data() {
        return {
            showImpressum: true,
        }
    },
    methods: {
        close() {
            this.showImpressum = false;
            this.$emit('show-impressum', this.showImpressum);
        }
    },
    template:
    `<h1>Privacy Policy for Abalo</h1>
    <h2>Information we collect</h2>

    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
    <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
    <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

    <h2>How we use your information</h2>

    <p>We use the information we collect in various ways, including to:</p>

    <ul>
    <li>Provide, operate, and maintain our website</li>
    <li>Improve, personalize, and expand our website</li>
    <li>Understand and analyze how you use our website</li>
    <li>Develop new products, services, features, and functionality</li>
    <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
    <li>Send you emails</li>
    <li>Find and prevent fraud</li>
    </ul>
    <button @click="close">Close</button>

    `
}
