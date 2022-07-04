import { Controller } from '@hotwired/stimulus';

import * as FilePond from 'filepond';

import 'filepond/dist/filepond.min.css';

const document = window.document;

export default class extends Controller {
    static targets = ["filepond"];
    static values = {
        uploadUrl: String
    }

    connect() {

        const pond = FilePond.create(this.filepondTarget);

        FilePond.setOptions({
            maxFiles: 5,
            server: {
                process: this.uploadUrlValue
            }
        });
    }
}
