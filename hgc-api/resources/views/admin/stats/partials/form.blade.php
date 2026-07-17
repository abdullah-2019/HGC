<div class="mb-3">
    <label>Key</label>
    <input type="text"
           name="key"
           class="form-control"
           value="{{ old('key', $stat->key ?? '') }}">
</div>

<div class="mb-3">
    <label>Value</label>
    <input type="number"
           name="value"
           class="form-control"
           value="{{ old('value', $stat->value ?? 0) }}">
</div>

<div class="mb-3">
    <label>Suffix</label>
    <input type="text"
           name="suffix"
           class="form-control"
           value="{{ old('suffix', $stat->suffix ?? '') }}">
</div>

<div class="mb-3">
    <label>English Label</label>
    <input type="text"
           name="label_en"
           class="form-control"
           value="{{ old('label_en', $stat->label_en ?? '') }}">
</div>

<div class="mb-3">
    <label>Dari Label</label>
    <input type="text"
           name="label_dari"
           class="form-control"
           value="{{ old('label_dari', $stat->label_dari ?? '') }}">
</div>

<div class="mb-3">
    <label>Pashto Label</label>
    <input type="text"
           name="label_pashto"
           class="form-control"
           value="{{ old('label_pashto', $stat->label_pashto ?? '') }}">
</div>

<div class="mb-3">
    <label>Icon Name</label>
    <input type="text"
           name="icon_name"
           class="form-control"
           value="{{ old('icon_name', $stat->icon_name ?? 'Building2') }}">
</div>

<div class="mb-3">
    <label>Sort Order</label>
    <input type="number"
           name="sort_order"
           class="form-control"
           value="{{ old('sort_order', $stat->sort_order ?? 0) }}">
</div>

<div class="form-check">
    <input type="checkbox"
           name="is_active"
           value="1"
           class="form-check-input"
           @checked(old('is_active', $stat->is_active ?? true))>

    <label class="form-check-label">
        Active
    </label>
</div>