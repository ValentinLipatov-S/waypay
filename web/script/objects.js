function MinPicker(node, callback) {
    this.min_price;
    this.callback = callback;

    this.min = document.createElement("input");
    this.min_span = document.createElement("span");
    this.div = document.createElement("div");

    this.div.classList.add("div_min");
    this.min.classList.add("min");
    this.min_span.classList.add("span_minmax");

    this.min.type = "number";
    this.min_span.textContent = "от";

    this.div.appendChild(this.min_span);
    this.div.appendChild(this.min);

    this.min.addEventListener("change", (function () {
        this.ChangeValue(this.min.value);
    }).bind(this));
    this.min.addEventListener("keyup", (function () {
        this.ChangeValue(this.min.value);
    }).bind(this));

    node.appendChild(this.div);
}
MinPicker.prototype.SetValue = function SetValue(value) {
    this.min_price = value;
    this.min.value = value;
}
MinPicker.prototype.ChangeValue = function ChangeValue(value) {
    if (this.min_price !== value) {
        this.min_price = value;
        this.callback("at", this.min_price);
    }
}
MinPicker.prototype.SetDefaultValue = function SetDefaultValue(value) {
    this.SetValue("");
}

function MaxPicker(node, callback) {
    this.max_price;
    this.callback = callback;

    this.max = document.createElement("input");
    this.max_span = document.createElement("span");
    this.div = document.createElement("div");

    this.div.classList.add("div_max");
    this.max.classList.add("max");
    this.max_span.classList.add("span_minmax");

    this.max.type = "number";
    this.max_span.textContent = "до";

    this.div.appendChild(this.max_span);
    this.div.appendChild(this.max);

    this.max.addEventListener("change", (function () {
        this.ChangeValue(this.max.value);
    }).bind(this));
    this.max.addEventListener("keyup", (function () {
        this.ChangeValue(this.max.value);
    }).bind(this));

    node.appendChild(this.div);
}
MaxPicker.prototype.SetValue = function SetValue(value) {
    this.max_price = value;
    this.max.value = value;
}
MaxPicker.prototype.ChangeValue = function ChangeValue(value) {
    if (this.max_price !== value) {
        this.max_price = value;
        this.callback("to", this.max_price);
    }
}
MaxPicker.prototype.SetDefaultValue = function SetDefaultValue(value) {
    this.SetValue("");
}

function SexChoose(node, callback) {
    this.sex = "man";
    this.node = node;
    this.callback = callback;

    this.sexchoice = document.createElement("div");
    this.sexchoice.classList.add("sexChoice");

    this.div_man = document.createElement("div");
    this.span_man = document.createElement("span");
    this.span_man.textContent = "Мужской";
    this.div_man.classList.add("sex");

    this.div_man.appendChild(this.span_man);
    this.sexchoice.appendChild(this.div_man);

    this.div_woman = document.createElement("div");
    this.span_woman = document.createElement("span");
    this.span_woman.textContent = "Женский";
    this.div_woman.classList.add("sex");

    this.div_woman.appendChild(this.span_woman);
    this.sexchoice.appendChild(this.div_woman);

    this.SetMan();

    this.div_man.addEventListener("click", this.ManClick.bind(this));
    this.div_woman.addEventListener("click", this.WomanClick.bind(this));

    this.node.appendChild(this.sexchoice);
}

SexChoose.prototype.ManClick = function ManClick() {
    this.SetMan();
    this.callback("sex", this.sex);
}

SexChoose.prototype.WomanClick = function WomanClick() {
    this.SetWoman();
    this.callback("sex", this.sex);
}
SexChoose.prototype.SetMan = function SetMan() {
    if (this.div_woman.classList.contains("active")) this.div_woman.classList.remove("active");
    if (!this.div_man.classList.contains("active")) this.div_man.classList.add("active");
    this.sex = "man";
}

SexChoose.prototype.SetWoman = function SetWoman() {
    if (!this.div_woman.classList.contains("active")) this.div_woman.classList.add("active");
    if (this.div_man.classList.contains("active")) this.div_man.classList.remove("active");
    this.sex = "woman";
}
SexChoose.prototype.SetDefaultValue = function SetDefaultValue() {
    this.SetMan();
}
SexChoose.prototype.SetValue = function SetValue(value) {
    if (value === "woman") this.SetWoman();
    else this.SetMan();
}
function CreateDiv(node, className) {
    this.node = document.createElement('div');
    this.node.className = className;
    node.appendChild(this.node);
}
function Container(node, value) {

    this.container = document.createElement("div");
    this.container_name = document.createElement("div");
    this.container_elements = document.createElement("div");

    this.node = this.container_elements;

    this.container.classList.add("container");
    this.container_name.classList.add("container_name");
    this.container_name.textContent = value;
    this.container_elements.classList.add("container_value");

    this.container.appendChild(this.container_name);
    this.container.appendChild(this.container_elements);

    node.appendChild(this.container);
}
Container.prototype.Clear = function Clear() {
    this.container.innerHTML = "";
}
function PopUpMenu(node, value) {
    this.visible = false;
    this.div = document.createElement('div');
    this.header = document.createElement('div');
    this.img = document.createElement('div');
    this.div_changer = document.createElement('div');

    this.div_elements = document.createElement('div');
    this.node = this.div_elements;

    this.div.classList.add("elements");
    this.div_changer.classList.add("elements_showhider");
    this.div_elements.classList.add("elements_elementslist");
    this.img.classList.add("elements_img");
    this.header.classList.add("elements_header");

    this.div_changer.textContent = value;

    this.header.addEventListener("click", (function () { this.ChangeVisible(); }).bind(this));

    this.header.appendChild(this.img);
    this.header.appendChild(this.div_changer);

    this.div.appendChild(this.header);

    this.div.appendChild(this.div_elements);

    node.appendChild(this.div);
}
PopUpMenu.prototype.Hide = function Hide() {
    this.visible = false;
    if (this.img.classList.contains('up'))
        this.img.classList.remove('up');
    if (this.div_changer.classList.contains('up'))
        this.div_changer.classList.remove('up');
    if (this.div_elements.classList.contains('up'))
        this.div_elements.classList.remove('up');
};
PopUpMenu.prototype.Show = function Show() {
    this.visible = true;
    if (!(this.img.classList.contains('up')))
        this.img.classList.add('up');
    if (!(this.div_changer.classList.contains('up')))
        this.div_changer.classList.add('up');
    if (!(this.div_elements.classList.contains('up')))
        this.div_elements.classList.add('up');
};
PopUpMenu.prototype.ChangeVisible = function ChangeVisible() {
    this.visible = !this.visible;
    this.img.classList.toggle("up");
    this.div_changer.classList.toggle("up");
    this.div_elements.classList.toggle("up");
};
PopUpMenu.prototype.Clear = function Clear() {
    this.div.innerHTML = "";
}
function CheckBox(container, node, name, id, value, callback) {
    this.id = id;
    this.name = name;
    this.container = container;
    this.checked = false;
    this.status = document.createElement('div');
    this.div = document.createElement('div');
    this.label = document.createElement('lable');
    this.status.classList.add("checkbox_status");
    this.div.classList.add("element");
    this.label.classList.add('checkbox_label');
    this.div.addEventListener("click", (function () {
        this.ChangeValue();
        callback(this);
    }).bind(this));
    this.label.textContent = value;
    this.div.appendChild(this.status);
    this.div.appendChild(this.label);
    node.appendChild(this.div);
}
CheckBox.prototype.SetTrue = function SetTrue() {
    this.checked = true;
    if (!(this.status.classList.contains('check'))) {
        this.status.classList.add('check');
        if (this.container !== undefined)
            this.container.Show();
    }
}
CheckBox.prototype.SetFalse = function SetFalse() {
    this.checked = false;
    if (this.status.classList.contains('check'))
        this.status.classList.remove('check');
}
CheckBox.prototype.ChangeValue = function ChangeValue() {
    this.checked = !this.checked;
    this.status.classList.toggle("check");
}
CheckBox.prototype.SetDefaultValue = function SetDefaultValue() {
    this.SetFalse();
}
CheckBox.prototype.SetValue = function SetValue(value) {
    if (value === "true") this.SetTrue();
    else this.SetFalse();
}






function Sort(node, callback) {
    this.node = node;
    this.callback = callback
    this.value = "date";

    this.mane = document.createElement("div");
    this.div = document.createElement("div");
    this.div_left = document.createElement("div");
    this.div_right = document.createElement("div");

    this.mane.classList.add("sort");
    this.div.classList.add("sort_div");
    this.div_left.classList.add("sort_div_left");
    this.div_right.classList.add("sort_div_right");

    this.span = document.createElement("span");
    this.sort_date_up = document.createElement("div");
    this.sort_date_down = document.createElement("div");
    this.sort_price_up = document.createElement("div");
    this.sort_price_down = document.createElement("div");

    this.sort_date_up.addEventListener("click", (function () { this.ChangeValue("dateup"); }).bind(this));
    this.sort_date_down.addEventListener("click", (function () { this.ChangeValue("datedown"); }).bind(this));
    this.sort_price_up.addEventListener("click", (function () { this.ChangeValue("priceup"); }).bind(this));
    this.sort_price_down.addEventListener("click", (function () { this.ChangeValue("pricedown"); }).bind(this));

    this.span.textContent = "Сортировать:";
    this.sort_date_up.textContent = "новые";
    this.sort_date_down.textContent = "старые";
    this.sort_price_up.textContent = "дешевле";
    this.sort_price_down.textContent = "дороже";

    this.span.classList.add("sort_span");
    this.sort_date_up.classList.add("sort_date_up");
    this.sort_date_down.classList.add("sort_date_down");
    this.sort_price_up.classList.add("sort_price_up");
    this.sort_price_down.classList.add("sort_price_down");


    this.div_left.appendChild(this.span);
    this.div_left.appendChild(this.sort_date_up);
    this.div_left.appendChild(this.sort_date_down);
    this.div_left.appendChild(this.sort_price_up);
    this.div_left.appendChild(this.sort_price_down);

    this.div.appendChild(this.div_left);
    this.div.appendChild(this.div_right);

    this.mane.appendChild(this.div);

    this.SetDefaultValue();

    this.node.appendChild(this.mane);
}
Sort.prototype.SetValue = function SetValue(value) {
    if (this.sort_date_up.classList.contains("selected"))
        this.sort_date_up.classList.remove("selected");
    if (this.sort_date_down.classList.contains("selected"))
        this.sort_date_down.classList.remove("selected");
    if (this.sort_price_up.classList.contains("selected"))
        this.sort_price_up.classList.remove("selected");
    if (this.sort_price_down.classList.contains("selected"))
        this.sort_price_down.classList.remove("selected");

    switch (value) {
        case "dateup":
            if (!this.sort_date_up.classList.contains("selected"))
                this.sort_date_up.classList.add("selected");
            this.value = "dateup";
            break;
        case "datedown":
            if (!this.sort_date_down.classList.contains("selected"))
                this.sort_date_down.classList.add("selected");
            this.value = "datedown";
            break;
        case "priceup":
            if (!this.sort_price_up.classList.contains("selected"))
                this.sort_price_up.classList.add("selected");
            this.value = "priceup";

            break;
        case "pricedown":
            if (!this.sort_price_down.classList.contains("selected"))
                this.sort_price_down.classList.add("selected");
            this.value = "pricedown";
            break;
        default: break;
    }
}
Sort.prototype.SetDefaultValue = function SetDefaultValue() {
    this.SetValue("dateup");
}
Sort.prototype.ChangeValue = function ChangeValue(value) {
    if (this.sort_date_up.classList.contains("selected"))
        this.sort_date_up.classList.remove("selected");
    if (this.sort_date_down.classList.contains("selected"))
        this.sort_date_down.classList.remove("selected");
    if (this.sort_price_up.classList.contains("selected"))
        this.sort_price_up.classList.remove("selected");
    if (this.sort_price_down.classList.contains("selected"))
        this.sort_price_down.classList.remove("selected");

    switch (value) {

        case "dateup":
            if (!this.sort_date_up.classList.contains("selected"))
                this.sort_date_up.classList.add("selected");
            this.value = "dateup";
            this.callback("sort", this.value);
            break;
        case "datedown":
            if (!this.sort_date_down.classList.contains("selected"))
                this.sort_date_down.classList.add("selected");
            this.value = "datedown";
            this.callback("sort", this.value);
            break;
        case "priceup":
            if (!this.sort_price_up.classList.contains("selected"))
                this.sort_price_up.classList.add("selected");
            this.value = "priceup";
            this.callback("sort", this.value);

            break;
        case "pricedown":
            if (!this.sort_price_down.classList.contains("selected"))
                this.sort_price_down.classList.add("selected");
            this.value = "pricedown";
            this.callback("sort", this.value);
            break;
        default: break;
    }
}



function Clear(node, callback) {
    this.node = node;
    this.callback = callback;

    this.div = document.createElement("div");
    this.div.classList.add("clear");
    this.div.textContent = "Сбросить";

    this.div.addEventListener("click", this.callback);

    this.node.appendChild(this.div);
}




function Search(node, callback) {
    this.value = "";
    this.node = node;
    this.callback = callback;

    this.div = document.createElement("div");
    this.div.classList.add("search");

    this.span = document.createElement("span");
    this.span.classList.add("search_span");


    this.input = document.createElement("input");
    this.input.type = "text";
    this.input.placeholder = "Поиск";
    this.input.classList.add("search_input");

    this.input.addEventListener("change", (function () {
        this.ChangeValue(this.input.value);
    }).bind(this));
    this.input.addEventListener("keyup", (function () {
        this.ChangeValue(this.input.value);
    }).bind(this));


    this.div.appendChild(this.span);
    this.div.appendChild(this.input);
    this.node.appendChild(this.div);
}

Search.prototype.SetDefaultValue = function SetDefaultValue(value) {
    this.value = "";
    this.input.value = "";
}
Search.prototype.ChangeValue = function ChangeValue(value) {
    if (this.value !== value) {
        this.value = value;
        this.callback("query", this.value);
    }
}
Search.prototype.SetValue = function SetValue(value) {
    this.value = value;
    this.input.value = value;
}






function Items(node) {
    this.node = node;
    this.Items = {};

    this.div_inner = document.createElement("div");
    this.node.appendChild(this.div_inner);

    this.div_loading = document.createElement("div");
    this.div_loading.classList.add("loading");

    this.div_loading_inner = document.createElement("div");
    this.div_loading_inner.classList.add("loading_inner");

    this.div_loading.appendChild(this.div_loading_inner);
    this.node.appendChild(this.div_loading);


    this.node = this.div_inner;
}
Items.prototype.Start = function Start() {
    if (!this.div_loading.classList.contains("active"))
        this.div_loading.classList.add("active")
}
Items.prototype.Stop = function Stop() {
    if (this.div_loading.classList.contains("active"))
        this.div_loading.classList.remove("active")
}
Items.prototype.Add = function Add(id, img, name, price, model, size, date) {
    this.Items[id] = new Item(this.node, id, img, name, price, model, size, date);
}
Items.prototype.Clear = function Clear() {
    delete this.Items;
    this.Items = {};
    this.node.innerHTML = "";
    this.Stop();
}
function Item(node, id, img, name, price, model, size, date) {
    this.node = node;
    this.id = id;
    this.name = name;
    this.img = img;
    this.model = model;
    this.date = date;
    this.size = size;
    this.price = price;

    this.div = document.createElement("div");
    this.div.classList.add("item");

    this.div_img = document.createElement("div");
    this.div_img.classList.add("item_img");
    this.div_img.style.backgroundImage = "url(" + this.img + ")";

    this.div_name_price = document.createElement("div");
    this.div_name_price.classList.add("item_name_price");

    this.div_name = document.createElement("div");
    this.div_name.classList.add("item_name");
    this.div_name.textContent = this.name;

    this.div_price = document.createElement("div");
    this.div_price.classList.add("item_price");
    this.div_price.textContent = this.price + "₽";

    this.div_model_size = document.createElement("div");
    this.div_model_size.classList.add("item_model_size");

    this.div_model = document.createElement("div");
    this.div_model.classList.add("item_model");
    this.div_model.textContent = this.model;

    this.div_size = document.createElement("div");
    this.div_size.classList.add("item_size");
    this.div_size.textContent = this.size;

    this.div_date_icons = document.createElement("div");
    this.div_date_icons.classList.add("item_date_icons");

    this.div_date = document.createElement("div");
    this.div_date.classList.add("item_date");
    this.div_date.textContent = this.date;

    this.div_icons = document.createElement("div");
    this.div_icons.classList.add("item_icons");

    this.div_name_price.appendChild(this.div_name);
    this.div_name_price.appendChild(this.div_price);

    this.div_model_size.appendChild(this.div_model);
    this.div_model_size.appendChild(this.div_size);

    this.div_date_icons.appendChild(this.div_date);
    this.div_date_icons.appendChild(this.div_icons);

    this.div.appendChild(this.div_img);
    this.div.appendChild(this.div_name_price);
    this.div.appendChild(this.div_model_size);
    this.div.appendChild(this.div_date_icons);

    node.appendChild(this.div);
}