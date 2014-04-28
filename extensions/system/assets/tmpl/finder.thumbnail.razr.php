{{#if data}}
<ul class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-4" data-uk-grid-margin data-uk-grid-match="{target:'.uk-panel'}">
    {{#each data.folders}}
    <li data-name="{{name}}" data-type="folder" data-url="{{url}}">
        <div class="uk-panel uk-panel-box uk-text-center uk-visible-hover" data-type="folder" data-url="{{url}}" data-row>
            <div class="uk-panel-teaser">
                <div class="pk-finder-thumbnail pk-finder-thumbnail-folder"></div>
            </div>
            <div class="uk-text-truncate">
                {{#if ../writable}}
                <input type="checkbox" class="js-select" data-name="{{name}}">
                {{/if}}
                <a href="#" data-cmd="loadPath" data-path="{{path}}">{{name}}</a>
            </div>
        </div>
    </li>
    {{/each}}

    {{#each data.files}}
    <li data-name="{{name}}" data-url="{{url}}" data-type="file">
        <div class="uk-panel uk-panel-box uk-text-center uk-visible-hover" data-url="{{url}}" data-type="file" data-row>
            <div class="uk-panel-teaser">
                <div class="pk-finder-thumbnail pk-finder-thumbnail-file"></div>
            </div>
            <div class="uk-text-nowrap uk-text-truncate">
                {{#if ../writable}}
                <input type="checkbox" class="js-select" data-name="{{name}}">
                {{/if}}
                {{name}}
            </div>
        </div>
    </li>
    {{/each}}
</ul>
{{/if}}

<div class="uk-placeholder uk-text-center uk-text-muted">
    <img src="@url.to('asset://system/images/icon-finder-droparea.svg')" width="22" height="22" alt="@trans('Droparea')"> @trans('Drop files here.')
</div>