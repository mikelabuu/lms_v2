import React from 'react';
import Autocomplete from '@mui/material/Autocomplete';
import TextField from '@mui/material/TextField';

export default function SelectAutocomplete(props) {
    const {
        id,
        name,
        label,
        options = [],
        getOptionLabel,
        defaultValue,
        placeholder,
        required,
        disabled,
        sx,
        fullWidth = true,
    } = props;

    const resolveLabel = React.useMemo(() => {
        if (typeof getOptionLabel === 'function') return getOptionLabel;
        if (options.length && typeof options[0] === 'object') {
            return (opt) => opt?.label ?? '';
        }
        return (opt) => String(opt ?? '');
    }, [getOptionLabel, options]);

    const [value, setValue] = React.useState(defaultValue ?? null);

    const hiddenValue = React.useMemo(() => {
        if (!name) return '';
        if (value == null) return '';
        if (typeof value === 'object') {
            return value.value ?? value.id ?? value.label ?? '';
        }
        return String(value);
    }, [name, value]);

    return (
        <>
            {name ? (
                <input type="hidden" name={name} value={hiddenValue} />
            ) : null}
            <Autocomplete
                disablePortal
                id={id}
                options={options}
                value={value}
                onChange={(_, newValue) => setValue(newValue)}
                getOptionLabel={resolveLabel}
                sx={{ width: fullWidth ? '100%' : 300, ...sx }}
                renderInput={(params) => (
                    <TextField {...params} label={label} placeholder={placeholder} required={required} disabled={disabled} />
                )}
            />
        </>
    );
}


