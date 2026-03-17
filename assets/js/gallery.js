(() => {

    function main() {
        const router = new Router({
            target: "#app",
            routes: {
                "gallery": () => galleryRoute(),
                "post": () => postRoute(),
                "setting": () => settingRoute(),
            }
        });

        document.querySelector('a[href="gallery"')?.addEventListener('click', (e) => router.interrupt(e, e.target.href));
        document.querySelector('a[href="post"')?.addEventListener('click', (e) => router.interrupt(e, e.target.href));
        document.querySelector('a[href="setting"')?.addEventListener('click', (e) => router.interrupt(e, e.target.href));
        addEventListener("popstate", () => router.render());

        if (router.render())
            router.navigate("gallery");
    }

    class Router {
        /**
         *
         * @param {{target: string, routes: {[key:string]: () => HTMLElement}}} params
         */
        constructor(params) {
            this.params = params;
            /** @type {HTMLElement} */
            this.element = document.querySelector(params.target ?? "") ?? null;
            this.redirectLoopGuard = 0;
        }

        interrupt(e, relative) {
            if (this.navigate(relative))
                e?.preventDefault();
        }

        addRoute(path, renderer) {
            this.params.routes[path] = renderer;
        }

        render() {
            const curURL = new URL(location.href);
            if (!this.element)
                return;
            const routeMethod = (() => {
                for (const route in this.params.routes) {
                    if (!curURL.pathname.endsWith(route))
                        continue;
                    return this.params.routes[route];
                }
                return this.params.routes['*'] ?? (() => document.createElement('div'));
            })();
            const newElement = routeMethod();
            if (newElement)
                this.element.replaceChildren(newElement);
            return newElement;
        }

        /**
         * 飛びます。100回まではnavigateをrender時に連続して呼び出せます。
         * @param {string} relative
         */
        navigate(relative) {
            if (this.redirectLoopGuard > 100)
                return null;
            this.redirectLoopGuard += 1;
            history.pushState({}, "", relative);
            const newElement = this.render();
            this.redirectLoopGuard -= 1;
            return newElement;
        }
    }

    class ElementBuilder {
        static create(tag) {
            return new ElementBuilder(tag);
        }

        constructor(tag) {
            /** @type {HTMLElement} */
            this.element = document.createElement(tag);
        }

        innerText(text) {
            this.element.innerText = text;
            return this;
        }

        render() {
            return this.element;
        }
    }

    const EB = ElementBuilder.create;
    function galleryRoute() {
        return EB().innerText('ギャラリーです').render();
    }

    function postRoute() {
        return EB().innerText('ポストです').render();
    }

    function settingRoute() {
        return EB().innerText('設定です').render();
    }

    class CamagruAPIClient { }

    main();
})();
