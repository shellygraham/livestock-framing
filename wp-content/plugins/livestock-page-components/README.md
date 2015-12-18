h2. Components

h3. Templates

Templates are placed in the template directory prefixed with `component-`.

At the top of the template Component Name and Component Description need to be defined so they can be retrieved with WordPress' `get_file_data()`

When a template is created it will be automatically included in the Components dropdown in WP Admin.

h3. Options

Optional options templates held in the components directory. The options template needs to match the template name.

For field names use `option[$index][field_name]`.
