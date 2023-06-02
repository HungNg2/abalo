<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body>
    <div class="app">
        <site-header></site-header><br>
        <site-body :ShowImpressum="this.ShowImpressum"></site-body><br>
{{--        <site-footer @show-impressum="impressum"></site-footer><br>--}}
    </div>
    <script type="module">
        import SiteHeader from "{{asset('/Vue/Components/siteheader.js')}}";
        import SiteBody from "{{asset('/Vue/Components//sitebody.js')}}";
        import SiteFooter from "{{asset('/Vue/Components//sitefooter.js')}}";
        let vm = Vue.createApp({
            components: {
                SiteHeader,SiteBody,SiteFooter
            },
            data: function() {
                return {
                    ShowImpressum: false,
                }
            },
            methods: {
                impressum(showImpressum) {
                    this.ShowImpressum = showImpressum;
                }
            }
        }).mount('.app');
    </script>
</body>
</html>
