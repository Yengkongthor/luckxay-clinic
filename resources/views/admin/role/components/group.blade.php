<tr class="table-active">
    <td colspan="4">
        @php
        $explode = explode('.', $name);
        echo ucfirst($explode[count($explode) == 1 ? 0 : 1]);
        @endphp
    </td>
</tr>
<tr>
    {{-- <td class="bulk-checkbox">
        <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="form.permissions"
            :value="item.id" v-validate="''" :data-vv-name="'enabled' + item.id"
            :name="'enabled' + item.id + '_fake_element'">
        <label class="form-check-label" :for="'enabled' + item.id">
        </label>
    </td> --}}
    {{-- <td>@{{ item.id }}</td> --}}
    {{-- <td>@{{ item.name }}</td> --}}
    {{-- <td>@{{ item.guard_name }}</td> --}}
    {{-- <td colspan="4">
        <div class="form-check form-check-inline"
            v-for="(item, index) in groupPermissions('{{ $name }}', {{ $equal ?? false }})">
    <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="form.permissions"
        :value="item.id" v-validate="''" :data-vv-name="'enabled' + item.id"
        :name="'enabled' + item.id + '_fake_element'">
    <label class="form-check-label" :for="'enabled' + item.id">
        @{{ item.name }}
    </label>
    </div>
    </td> --}}
    <td colspan="4">
        @foreach ($values as $item)
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="enabled{{ $item->id }}" type="checkbox" v-model="form.permissions"
                value="{{ $item->id }}" v-validate="''" data-vv-name="enabled{{ $item->id }}"
                name="enabled{{ $item->id }}_fake_element">
            <label class="form-check-label" for="enabled{{ $item->id }}">
                {{ $item->name }}
            </label>
        </div>
        @endforeach
    </td>
</tr>
