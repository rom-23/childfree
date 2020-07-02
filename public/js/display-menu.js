function jsonMe() {
    const route = 'menu';
    const secondSuite2 = document.querySelector('#display-view2');
    const secondSuite = document.querySelector('#display-view');
    const getView = async function () {
        try {
            let response = await fetch(route);
            if (response.ok) {
                secondSuite2.innerHTML = "";
                secondSuite.innerHTML = "";
                let data = await response.json();
                secondSuite2.innerHTML = data['view'];
            }
        } catch (e) {
            alert(e.message);
        }
    };
    return getView();

}
