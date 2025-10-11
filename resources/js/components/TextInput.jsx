import React from 'react';
import TextField from '@mui/material/TextField';

export default function TextInput(props) {
    const {
        id,
        name,
        label,
        variant = 'outlined',
        defaultValue = '',
        placeholder,
        type = 'text',
        required,
        fullWidth = true,
        size,
        helperText,
        disabled,
        readOnly,
        inputProps,
    } = props;

    const [value, setValue] = React.useState(String(defaultValue ?? ''));

    return (
        <>
            {name ? (
                <input type="hidden" name={name} value={value} />
            ) : null}
            <TextField
                id={id}
                label={label}
                variant={variant}
                value={value}
                onChange={(e) => setValue(e.target.value)}
                placeholder={placeholder}
                required={required}
                fullWidth={fullWidth}
                size={size}
                helperText={helperText}
                disabled={disabled}
                type={type}
                InputProps={{ readOnly, ...inputProps }}
            />
        </>
    );
}


