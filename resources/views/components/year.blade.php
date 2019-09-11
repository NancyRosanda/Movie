<select name="year" required="true" value="{{ old('year') }}">
    @foreach (range('2019','1900') as $godina)
    <option>{{ $godina }}</option>
    @endforeach
</select>