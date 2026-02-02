<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\UpdateRestaurantRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
 
class UpdateRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('restaurant.update');
    }
 
    public function rules(): array
    {
        return [
            'restaurant_name' => ['required', 'string', 'max:255'],
            'city'            => ['required', 'numeric', 'exists:cities,id'],
            'address'         => ['required', 'string', 'max:1000'],
        ];
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
{
    $validated = $request->validated();
 
    $restaurant->update([
        'city_id' => $validated['city'],
        'name'    => $validated['restaurant_name'],
        'address' => $validated['address'],
    ]);
 
    return to_route('admin.restaurants.index')
        ->withStatus('Restaurant updated successfully.');
}
}