import { renderizarFormulario } from "../form/form";

export let editTag = (editButton) => {

    let url = editButton.dataset.url;
    let group = editButton.dataset.group;
    let key = editButton.dataset.key;

    let groupKey = {};
    groupKey['group'] = group;
    groupKey['key'] = key;

    let json = JSON.stringify(groupKey);

    console.log(json);

    let forms = document.querySelectorAll(".admin-formulario");

    forms.forEach(form => {
        let sendGetRequest = async () => {
            try {
                await axios.get(url, {
                    params: {
                        groupKey: json
                    }
                }).then(response => {
                    form.innerHTML = response.data.form;
                    renderizarFormulario();
                });

            } catch (error) {
                console.log("fallo");
             }
        };
        sendGetRequest();
    });
};