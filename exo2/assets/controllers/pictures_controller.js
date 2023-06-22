import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    static targets = ["collection"]

    static values = {
        index: Number,
        prototype: String,
    }

    add(event) {
        const item = document.createElement('div');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        this.collectionTarget.appendChild(item);
        this.indexValue++;
    }
}